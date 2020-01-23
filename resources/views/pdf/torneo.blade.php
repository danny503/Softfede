<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de torneo</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
 
        #imagen{
        width: 100px;
        }
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #gracias{
        text-align: center; 
        }
    </style>
    <body>
        @foreach ($torneo as $t)
        <header>
            <div id="logo">
                <img src="admin/img/baloncesto.jpg" alt="CompartiendoCodigo" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Sub federación de baloncesto</b><br>Chalatenango, Chalatenango<br>
                </p>
            </div>          
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <th id="fac">Torneo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">TORNEO: {{$t->nombre}}<br>
                            CATEGORIA: {{$t->nombre_categoria}}<br>
                            FECHA INICIO: {{$t->fecha_inicio}}<br>
                            FECHA FIN: {{$t->fecha_fin}}<br>
                            RAMA: {{$t->rama}}</br>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>     
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <td>LOGO</td>
                            <th>EQUIPO</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                        <td ><img src="images/{{ $det->logo }}" alt="No hay foto" id="imagen"></td>
                            <td>{{$det->equipo}}</td>                       
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
        </footer>
    </body>
</html>