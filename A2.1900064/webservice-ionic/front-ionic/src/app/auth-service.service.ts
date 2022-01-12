import { Injectable } from '@angular/core';
import { Observable, } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';

const httpOptions = {
  headers: new HttpHeaders({'Content-Type': 'application/json'})
};
const apiUrl = "http://localhost/webservice-ionic";

@Injectable({
  providedIn: 'root'
})
export class AuthServiceService {

  constructor(private http: HttpClient) { }

// Dua Fungsi untuk Get data dan post data
  Get_Data(type): Observable<any> {
    return this.http.get(`${apiUrl}/${type}`);
  }
//credentials fungsi yang akan dikirim ke web service
//httpOption opsi header
  Post_Data(type,credentials): Observable<any>{
    return this.http.post(`${apiUrl}/${type}`,credentials,httpOptions);
  }
}
