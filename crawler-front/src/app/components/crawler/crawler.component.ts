import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { CrawlerService } from 'src/app/services/crawler.service';

@Component({
  selector: 'app-crawler',
  templateUrl: './crawler.component.html',
  styleUrls: ['./crawler.component.css']
})
export class CrawlerComponent implements OnInit {

  form: FormGroup;
  urls: any;

  constructor(private formBuilder: FormBuilder,
    private crawlerService: CrawlerService) { }


  ngOnInit() {
    this.form = this.formBuilder.group({
      url: [null, [Validators.required]],
      depth: [null, Validators.required],
    });
  }


  refresh() {
    this.form.reset();
    this.urls = null;


  }

  submit() {
    this.urls = null;
    this.form.markAllAsTouched();
    if (this.form.valid) {
      this.crawlerService.crawl(this.form.value).subscribe(res => {
        if (res) {
          this.urls = res
        }


      })
    }
  }
}
