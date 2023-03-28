import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { catchError, throwError, Observable, map } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private loginUrl = 'api/login';
  private signupUrl = 'api/signup';

  errorData = {};
   
  constructor(
    private httpClient: HttpClient
  ) { }
  
  login (email: string, password: string) {
    return this.httpClient.post<any>(this.loginUrl, {"email": email, "password": password})
      .pipe(map(user => {
        if (user) {
          //localStorage.setItem('currentUser', JSON.stringify(user[0]['Email']));
          return user[0];
        }
      }),
      catchError((err) => {
        return throwError(err);
      }));
  };

  signup (signupInfo: Object) {
    //console.log('check email');
    return this.httpClient.post<any>(this.signupUrl, signupInfo);
  }

  checkIfExists (email: string) {
    const emailUrl = 'api/signup/exists'
    return this.httpClient.post<any>(emailUrl, {"email": email})
  }
}
