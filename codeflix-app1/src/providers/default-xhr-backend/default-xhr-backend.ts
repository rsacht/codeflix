import { Injectable } from '@angular/core';
import {
    BrowserXhr,
    Request,
    ResponseOptions,
    Response,
    XHRBackend,
    XHRConnection,
    XSRFStrategy
} from "@angular/http";
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';
import {Observable} from "rxjs/Observable";
import {appContainer} from "../../app/app.container";
import {JwtClientProvider} from "../jwt-client/jwt-client";

/*
  Generated class for the DefaultXhrBackendProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class DefaultXhrBackendProvider extends XHRBackend {

    constructor(browserXHR: BrowserXhr,
                baseResponseOptions: ResponseOptions,
                xsrfStrategy: XSRFStrategy) {
        super(browserXHR, baseResponseOptions, xsrfStrategy);
    }

    createConnection(request: Request): XHRConnection {
        let xhrConnection = super.createConnection(request);
        xhrConnection.response = xhrConnection
            .response
            .map((response) =>{
                this.tokenSetter(response);
                return response;
            })
            .catch(responseError =>{
                //Verificar se é o status 401 e redirecionar para o login
                return Observable.throw(responseError);
            });
        return xhrConnection;
    }

    tokenSetter(response: Response){
        let jwtClient = appContainer().get(JwtClientProvider);
        if(response.headers.has('Authorization')){
            let authorization = response.headers.get('Authorization');
            let token = authorization.replace('Bearer', '');
            jwtClient.setToken(token);
        }
    }


}