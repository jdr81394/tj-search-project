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

  sendEmail(cart, name, senderEmail, message) {
    console.log("name in ts:  "  ,name);
    console.log("senderemail in ts:  " , senderEmail);
    console.log("message in ts:  " ,message);
    const params = new HttpParams()
    .set('action', 'sendEmail')
    .set('cart', JSON.stringify(cart))
    .set('name', name)
    .set('senderEmail', senderEmail)
    .set('message', message);
    console.log("params total :  "  ,params);

    return this.http.post('http://localhost:9000/',  params);

  }



  
}
