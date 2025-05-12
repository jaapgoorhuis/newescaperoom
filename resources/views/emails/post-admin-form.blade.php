<table style="background-color:white; border:2px solid #1D140C; color:#676767; font-family: math" width="800" class="panel" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td class="panel-content">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="panel-item" style="background-color:#1D140C;  padding:15px; color:white;" width="200">
                        <img src="{{asset('/storage/images/logo_white.png')}}" width="65" alt="Logo Decodoors"/>
                    </td>
                </tr>
                <tr>
                    <td style="padding:50px;">
                        <div style="padding:50px; color:#676767; font-size: 16px; margin-top: 25px;">
                            <h2>Er is een aanvraag gedaan op: <strong><a style="color:#6E5E50" href="https://decodoors.nl/offerte-aanvragen">https://decodoors.nl</a></strong></h2><br/>
                            @if($data['type'] == 'offerte')
                                De klant heeft gekozen om een offerte te ontvangen. De offerte ontvangt hij binnen 2 werkdagen.<br/><br/>
                            @else
                                De klant heeft gekozen om de bestelling definitief te plaatsen.<br/><br/>
                            @endif
                            Hieronder het overzicht van de aanvraag.

                            <br/>
                            <br/>


                            <br/>
                            <strong>De deur:</strong><br/><br/>
                            <div style="font-size:15px">
                                <strong>1. De samenstelling</strong>
                                <hr>
                                <table style="color:#676767; width: 100%; font-family: math">
                                    <tr>
                                        <td style="width:50%">Enkele/ Dubbele deur:</td>
                                        <td>{{$data['enkelDubbel']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%">Type deur:</td>
                                        <td>{{$data['typeDeur']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Hoogte deur:</td>
                                        <td>{{$data['hoogte']}}cm</td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%">Breedte:</td>
                                        <td>{{$data['breedte']}}cm</td>
                                    </tr>
                                    @if($data['enkelDubbel'] == 'Enkele deur')
                                        <tr>
                                            <td style="width:50%">Draairichting:</td>
                                            <td>{{$data['draairichting']}}</td>
                                        </tr>
                                    @endif
                                </table>

                                <br/>
                                <strong>2. Het ontwerp</strong>
                                <hr>

                                <table style="color:#676767; width: 100%; font-family: math">

                                    <tr>
                                        <td style="width:50%">Model deur:</td>
                                        <td>{{$data['modelDoor']}}</td>
                                    </tr>

                                    @if(count($data['color_choise']))
                                        <tr>
                                            <td style="width:50%"></td>
                                            @if($data['colorSampleOrDefColor'] == 'Sample')
                                                <td>De klantheeft gekozen om kleurstalen aan te vragen.</td>
                                            @else
                                                <td>De klant heeft een definitieve kleur gekozen.</td>
                                            @endif
                                        </tr>
                                    @endif

                                    <tr>
                                        <td style="width:50%">Gekozen kleur:</td>
                                        @if(count($data['color_choise']))
                                            @foreach($data['color_choise'] as $color)
                                                {{$color}},
                                            @endforeach
                                        @else
                                            <td>Geen kleur gekozen</td>
                                        @endif
                                    </tr>


                                    <tr>
                                        <td style="width:50%">Glas keuze:</td>
                                        <td>{{$data['glas']}}</td>
                                    </tr>
                                </table>

                                <br/>
                                <strong>3. Deurgreep</strong>
                                <hr>

                                <table style="color:#676767; width: 100%; font-family: math">
                                    <tr>
                                        <td style="width:50%">Gekozen voor een deurgreep:</td>
                                        <td>
                                            @if($data['greepOption'])
                                                Ja
                                            @else
                                                Nee
                                        @endif
                                    </tr>
                                    @if($data['greepOption'])
                                        <tr>
                                            <td style="width:50%">Type deurgreep:</td>
                                            <td>{{$data['typeGreep']}}</td>
                                        </tr>
                                    @endif

                                    @if($data['typeGreep'] == 'Greep' && $data['greepOption'])
                                        <tr>
                                            <td style="width:50%">Lengte deurgreep:</td>
                                            <td>{{$data['greep']}}</td>
                                        </tr>
                                    @endif

                                    @if($data['typeDeur'] == 'Draaideur')
                                        @if($data['typeGreep'] == 'Klink')
                                            <tr>
                                                <td style="width:50%">Kleur beslag:</td>
                                                <td>{{$data['greepColor']}}</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td style="width:50%">Scharnier:</td>
                                            <td>{{$data['scharnier']}}</td>
                                        </tr>

                                    @endif
                                </table>


                                <br/>
                                <strong>4. Opties</strong>
                                <hr>

                                <table style="color:#676767; width: 100%; font-family: math">

                                    <tr>
                                        <td style="width:50%">Vakkundig laten inmeten:</td>
                                        <td>  @if($data['inmeten'])
                                                Ja
                                            @else
                                                Nee
                                            @endif</td>
                                    </tr>
                                    @if($data['monteren'])
                                    <tr>
                                        <td style="width:50%">Vakkundig laten monteren:</td>
                                        <td>  @if($data['monteren'])
                                                Ja
                                            @else
                                                Nee
                                            @endif</td>
                                    </tr>
                                    @else
                                        <tr>
                                            <td style="width:50%">Zelf monteren:</td>
                                            <td>  @if($data['zelfMonteren'])
                                                    Ja
                                                @else
                                                    Nee
                                                @endif
                                            </td>
                                        </tr>
                                    @endif


                                    <tr>
                                        <td style="width:50%">Levering:</td>
                                        <td>  @if($data['monteren'])
                                                Bezorgen
                                            @elseif($data['afhalen'])
                                                Afhalen
                                            @else
                                                  Onbekend
                                            @endif
                                        </td>
                                    </tr>


                                </table>

                                <br/>
                                <strong>5. Klantgegevens</strong>
                                <hr>

                                <table style="color:#676767; width: 100%; font-family: math">
                                    <tr>
                                        <td style="width:50%">Klant naam:</td>
                                        <td>{{$data['voornaam']}} {{$data['achternaam']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%">Klant E-mailadres</td>
                                        <td>{{$data['email']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Klant telefoonnummer:</td>
                                        <td>{{$data['telefoon']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Klant straat + huisnummer:</td>
                                        <td>{{$data['straat']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Klant postcode:</td>
                                        <td>{{$data['postcode']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Klant plaats:</td>
                                        <td>{{$data['plaats']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Klant land:</td>
                                        <td>{{$data['land']}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

