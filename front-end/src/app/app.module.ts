import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import  { FormsModule } from '@angular/forms';

import { JwPaginationComponent } from 'jw-angular-pagination';
import { AppComponent } from './app.component';

import { HttpModule } from '@angular/http';
import { HttpClientModule } from '@angular/common/http';

@NgModule({
  declarations: [
    AppComponent,
    JwPaginationComponent
  ],
  imports: [
    HttpModule,
    FormsModule,
    HttpClientModule,
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
