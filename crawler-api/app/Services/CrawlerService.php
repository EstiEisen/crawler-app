<?php
   
   namespace App\Services;

   use App\Models\BaseUrl;
   use App\Models\Page;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Requests\CrawlRequest;
use App\Http\Resources\CrawlerResource;
use App\Services\CrawlerService;
use Symfony\Component\HttpFoundation\Response;

   use Illuminate\Support\Facades\DB;

   
   class CrawlerService
   {
     protected BaseUrl $baseUrl;
     private $url;
     private $client;
     private $response;
     private $statusCode;


    public function __construct($url, $depth = 1)
    {

        $this->url = $url;
     
        $this->checkStatusUrl($url);

        if ($this->statusCode !== Response::HTTP_OK) {
            throw new Exception($this->statusCode);  
              }
        
        if($this->checkBaseUrlExist())
         {
            $this->baseUrl =BaseUrl::where('url',$this->url)->first();
        } 
        else
        {
            $this->baseUrl = $this->saveBaseUrl();
            $this->crawlPage($url,$depth);
        }
       
 
    }

    private function saveBaseUrl()
    {
        return BaseUrl::updateOrCreate(['url' => $this->url]);
    }

    public function checkBaseUrlExist(){
        return (BaseUrl::where('url',$this->url)->exists());
    }

  
    private function checkStatusUrl($url)
    {
        $this->client = new Client(['verify' => false]);
        $this->response = $this->client->request('GET', $url);
        $this->statusCode = $this->response->getStatusCode();
    }

    private function crawlPage($url, $depth)
    {
        try{
            $this->checkStatusUrl($url) ;    
        if ($this->statusCode === Response::HTTP_OK) {
            $html = (string)$this->response->getBody();
            if(!Page::where('url',$url)->where('base_url_id',$this->baseUrl->id)->exists()) {
            $pageModel = $this->savePage( $url);
            $this->baseUrl->pages()->save($pageModel);
            }  
 } 
}
 catch (\Exception $e) {
  return;
}
        if ($depth > 1) {
            $crawler = new Crawler($html,$url);
            $crawler->filter('a')->each(function ($node) use($depth) {
                $link = $node->link();
                $this->crawlPage($link->getUri(),$depth-1);
            });
        }
        
     
    }

    private function savePage( $url)
    {
        $page = new Page();
        $page->base_url_id = $this->baseUrl->id;
        $page->url = $url;
        $page->save();

        return $page;
    }

    public function response(){
        return response(CrawlerResource::collection($this->baseUrl->pages));
    }

  
}   
