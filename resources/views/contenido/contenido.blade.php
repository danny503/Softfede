@extends('principal')
@section('contenido')

@if(Auth::check())
            @if (Auth::user()->idrol == 1)                            
            <template v-if="menu==0">
            <index></index>
            </template>
            <template v-if="menu==1">
            <user></user>
            </template>
            <template v-if="menu==2">
            <a href="./auth/contenido"></a>
            </template>
            <template v-if="menu==3">
            <jugador></jugador>
            </template>
            <template v-if="menu==4">
            <cuerpotecnico></cuerpotecnico>
            </template>
            <template v-if="menu==5">
            <equipo-component></equipo-component>
            </template>
            <template v-if="menu==6">
            <arbitro></arbitro>
            </template>
            <template v-if="menu==7">
            <torneo></torneo>
            </template>
            <template v-if="menu==8">
            <categoria></categoria>
            </template>
            <template v-if="menu==9">
            <rama-component></rama-component>
            </template>
            <template v-if="menu==10">
            <sede-component></sede-component>
            </template>
            <template v-if="menu==11">
            <tipo></tipo>
            </template>
            <template v-if="menu==12">
            <update></update>
            </template>
            <template v-if="menu==13">
            <tablaposicion></tablaposicion>
            </template>
            <template v-if="menu==14">
            <h1>Contenido 14</h1>
            </template>
            <template v-if="menu==15">
            <puntajepartido></puntajepartido>
            </template>
            <template v-if="menu==16">
            <propartido></propartido>
            </template>
            <template v-if="menu==17">
            <partidosprogramados></partidosprogramados>
            </template>
            <template v-if="menu==18">
            <rol></rol>
            </template>
            <template v-if="menu==19">
            <h1>Contenido 19</h1>
            </template>
            <template v-if="menu==20">
            <h1>Contenido 20</h1>
            </template>
            <template v-if="menu==21">
            <h1>Contenido 21</h1>
            </template>
            <template v-if="menu==22">
            <equipos></equipos>
            </template>
            @elseif (Auth::user()->idrol == 2)
                
            @elseif (Auth::user()->idrol == 3)
            <template v-if="menu==0">
            <index></index>
            </template>
            <template v-if="menu==4">
            <cuerpotecnico></cuerpotecnico>
            </template>
            <template v-if="menu==5">
            <equipo-component></equipo-component>
            </template>
            <template v-if="menu==3">
            <jugador></jugador>
            </template>
            <template v-if="menu==22">
            <equipos></equipos>
            </template>
            <template v-if="menu==11">
            <tipo></tipo>
            </template>
           
             @elseif (Auth::user()->idrol == 4)
             <template v-if="menu==0">
            <index></index>
            </template>
            <template v-if="menu==4">
            <cuerpotecnico></cuerpotecnico>
            </template>
            <template v-if="menu==5">
            <equipo-component></equipo-component>
            </template>
            <template v-if="menu==3">
            <jugador></jugador>
            </template>
            <template v-if="menu==15">
            <puntajepartido></puntajepartido>
            </template>
            <template v-if="menu==17">
            <partidosprogramados></partidosprogramados>
            </template>
            @else
           
 
            @endif

            @endif         
        
 @endsection