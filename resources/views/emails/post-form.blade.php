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
                        <div style="padding:50px; color:#676767; margin-top: 25px;">
                            <h2>Bedankt voor uw aanvraag op: <strong><a style="color:#6E5E50" href="https://decodoors.nl/offerte-aanvragen">https://decodoors.nl</a></strong></h2><br/>
                            @if($data['type'] == 'offerte')
                            U heeft gekozen om een offerte te ontvangen. De offerte ontvangt u binnen 2 werkdagen.<br/><br/>
                            @else
                                U heeft gekozen om de bestelling definitief te plaatsen. Wij nemen zo spoedig mogelijk contact met u op om een afspraak in te plannen.<br/><br/>
                            @endif
                            Hieronder vind u het overzicht van uw aanvraag. Controleer de gegevens goed of ze correct zijn. Klopt er iets niet? Neem dan contact op met onze klantenservice.<br/><br/>
                            <strong>Klantenservice:</strong><br/>
                            E-Mailadres: info@decodoors.nl<br/>

                            <br/>
                            <br/>


                            <br/>
                            <strong>Uw deur:</strong><br/><br/>
                            <div>
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
                                                <td>U heeft gekozen om kleurstalen aan te vragen.</td>
                                            @else
                                                <td>U heeft een definitieve kleur gekozen.</td>
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
                                <strong>5. Uw gegevens</strong>
                                <hr>

                                <table style="color:#676767; width: 100%; font-family: math">
                                    <tr>
                                        <td style="width:50%">Uw naam:</td>
                                        <td>{{$data['voornaam']}} {{$data['achternaam']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%">Uw E-mailadres</td>
                                        <td>{{$data['email']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Uw telefoonnummer:</td>
                                        <td>{{$data['telefoon']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Straat + huisnummer:</td>
                                        <td>{{$data['straat']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Postcode:</td>
                                        <td>{{$data['postcode']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Plaats:</td>
                                        <td>{{$data['plaats']}}</td>
                                    </tr>

                                    <tr>
                                        <td style="width:50%">Land:</td>
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

