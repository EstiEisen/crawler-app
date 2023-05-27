import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CrawlerComponent } from './components/crawler/crawler.component';

const routes: Routes = [
  {
    path: 'home', 
    component: CrawlerComponent
  },
  {
    path: '', 
    redirectTo: '/home', 
    pathMatch: 'full'
  },];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
