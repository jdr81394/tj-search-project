import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CartComponent } from './cart/cart.component';

const routes: Routes = [

  {
    path: 'cart',
    component: CartComponent
    // loadChildren: './cart/cart.module#CartModule'
  }


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
