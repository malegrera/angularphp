import { Component } from '@angular/core';

import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
    url: string = 'http://localhost/server/';
    datos: any;
    formulario:boolean;
    tabla:boolean;
    alumno = {
      idUsuario: null,
      nombre: null,
      apellidos: null,
      estatura: null
    }
    constructor(private http: HttpClient) {
      this.formulario=false;
      this.tabla=false;
    }
  ver() {
    this.formulario=false;
    this.tabla=!this.tabla;
    if (this.tabla)
    this.http.get<any>(`${this.url}leer.php`).subscribe((data) => {
      this.datos = data;
      console.log(this.datos);
    });
  }
  insertar() {
    this.http.post<any>(`${this.url}insertar.php`,this.alumno).subscribe((data) => {
      this.datos = data;
      console.log(this.datos);
    });
  }
}
