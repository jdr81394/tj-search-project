import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { SearchItemsComponent } from './search-items.component';

import { ItemsServiceService } from '../items-service/items-service.service';

import { MatFormFieldModule } from '@angular/material/form-field';
import { MatSelectModule } from '@angular/material/select';
import { MatButtonModule } from '@angular/material/button';
import { MatInputModule } from '@angular/material/input';


@NgModule({
  declarations: [
    SearchItemsComponent,
  ],
  imports: [
    MatFormFieldModule,
    MatSelectModule,
    BrowserModule,
    MatInputModule,
    MatButtonModule
  ],
  providers: [ItemsServiceService],
  bootstrap: []
})
export class SearchItemsModule { }
