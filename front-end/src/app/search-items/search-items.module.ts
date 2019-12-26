import { BrowserModule } from '@angular/platform-browser';
import  { FormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';

import { SearchItemsComponent } from './search-items.component';

import { ItemsServiceService } from '../items-service/items-service.service';

// import { MatFormFieldModule } from '@angular/material/form-field';
// import { MatSelectModule } from '@angular/material/select';
// import { MatButtonModule } from '@angular/material/button';
// import { MatInputModule } from '@angular/material/input';
import { HttpModule } from '@angular/http';
import { HttpClientModule} from '@angular/common/http';

@NgModule({
  declarations: [
    SearchItemsComponent,
  ],
  imports: [
    HttpModule,
    HttpClientModule,
    FormsModule,
    // MatFormFieldModule,
    // MatSelectModule,
    BrowserModule
    // MatInputModule,
    // MatButtonModule
  ],
  exports:[SearchItemsComponent],
  providers: [ItemsServiceService],
  bootstrap: []
})
export class SearchItemsModule { }
