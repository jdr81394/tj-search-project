import { Injectable } from '@angular/core';
import { HttpClient, HttpParams, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ItemsServiceService {

  constructor(
    private http: HttpClient

  ) { }

  getItems(basicSearch) {
    const params = new HttpParams()
    .set('action','basicSearch')
    .set('name', basicSearch);

    // Jake - the first argument will need to be a route to whatever the backend server is.
    return this.http.get('http://localhost:9000/', {params: params});
  }

  sendEmail(cart, textarea) {
    console.log("in send email in service");
    const params = new HttpParams()
    .set('action', 'sendEmail')
    .set('cart', cart)
    .set('textarea', textarea);

    return this.http.post('http://localhost:9000/', {params: params});

  }



  
}
