<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\BaseUrl;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Requests\CrawlRequest;
use App\Http\Resources\CrawlerResource;
use App\Services\CrawlerService;
use App\Services\Helpers;
use Exception;

use Symfony\Component\HttpFoundation\Response;

class CrawlController extends Controller
{
    public function crawl(CrawlRequest $request)
    {
        $url = $request->input('url');
        $depth = $request->input('depth', 1);
    try{
       $crawl= new CrawlerService($url, $depth);
       return $crawl->response();
    }
    catch (Exception $exception) {
        return Helpers::Response400($exception->getMessage());
    }

     
    }

}
