import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map } from 'rxjs/operators';

const httpOptions = {
  Headers: new HttpHeaders({ 'Content-Type': 'Aplication/json' })
};
// Alamat apiURL webservice
const apiURL = "http://localhost/webservice-ionic";

@Injectable({
  providedIn: 'root'
})
export class AuthServiceService {

  constructor(private http: HttpClient) { }
  // Dua fungsi untuk Get data dan post data 
  Get_Data(type): Observable<any> {
    return this.http.get('${apiURL}/${type}');
  }
  Post_Data(type, credentials): Observable<any> {
    // Credentials fungsi yang akan dikirim ke webservice
    // httpOption opsi header 
    return this.http.post('${apiURL}$/{type}', credentials, httpOptions)
  }
}
