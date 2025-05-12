<table style="background-color:white; border:2px solid #676767; color:#676767; font-family: math" width="800" class="panel" cellpadding="0" cellspacing="0" role="presentation">
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
                            <h2>Contactformulier ingevuld</h2>
                            <p>Het contactformulier op decodoors is ingevuld</p>
                            <br/>
                            <strong>Gegevens:</strong><br/><br/>
                            <strong>Naam: </strong>{{$data['voornaam']}} {{$data['achternaam']}}<br/>
                            <strong>Telefoonnummer: </strong>{{$data['telefoonnummer']}}<br/>
                            <strong>E-mailadres: </strong>{{$data['email']}}<br/>
                            <strong>Bericht: </strong>{{$data['bericht']}}<br/>

                            <br/>
                            <br/>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

