import { Injectable } from '@angular/core';
import {JwtCredentials} from "../../models/jwt-credentials";
import {Headers, RequestOptions, Response} from "@angular/http";
import 'rxjs/add/operator/map';
import {Storage} from "@ionic/storage";
import {AuthHttp, JwtHelper} from "angular2-jwt";
import {Env} from "../../models/env";

/*
  Generated class for the JwtClientProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
declare var ENV:Env;
@Injectable()
export class JwtClientProvider {

    private _token = null;
    private _payload = null;

    constructor(
        public authHttp: AuthHttp,
        public storage: Storage,
        public jwtHelper: JwtHelper
    ) {
        this.getToken();
        this.getPayload().then((payload) =>{
            console.log(payload);
        });
    }

    getPayload():Promise<Object>{
        return new Promise((resolve) => {
            if(this._payload){
                resolve(this._payload);
            }
            this.getToken().then((token) => {
                if(token){
                    this._payload = this.jwtHelper.decodeToken(token);
                }
                resolve(this._payload);
            });
        });
    }
    getToken():Promise<string>{
        return new Promise((resolve) => {
            if(this._token){
                resolve(this._token);
            }
            this.storage.get(ENV.TOKEN_NAME).then((token) => {
                this._token = token;
                resolve(this._token);
            });
        });
    }

    setToken(token: string): string {
        this._token = token;
        this.storage.set(ENV.TOKEN_NAME, token);
        return token;
    }

    accessToken(jwtCredentials: JwtCredentials): Promise<string>{
        return this.authHttp.post(`${ENV.API_URL}/access_token`, jwtCredentials)
            .toPromise()
            .then((response: Response) =>{
                let token = response.json().token;
                this._token = token;
                this.storage.set(ENV.TOKEN_NAME, this._token);
                return token;
            });
    }

    revokeToken():Promise<null>{
        let headers = new Headers();
        headers.set('Authorization', `Bearer ${this._token}`);
        let requestOptions = new RequestOptions({headers});
        return this.authHttp.post(`${ENV.API_URL}/logout`, {}, requestOptions)
            .toPromise()
            .then((response: Response) =>{
                this._token = null;
                this._payload = null;
                this.storage.clear();
                return null;
            });
    }
}
