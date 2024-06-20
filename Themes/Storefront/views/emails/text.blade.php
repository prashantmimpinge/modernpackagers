<!DOCTYPE html>
<html lang="en" style="-ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    -webkit-print-color-adjust: exact;"
>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    </head>

    <body style="font-family: 'Open Sans', sans-serif;
                font-size: 15px;
                min-width: 320px;
                margin: 0;"
    >
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="padding: 0;">
                        <table style="border-collapse: collapse; width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="background: #fff; text-align: left;">
                                        @if (is_null($logo))
                                            <h5 style="font-size: 30px;
                                                    line-height: 36px;
                                                    margin: 0;
                                                    padding: 30px 15px;
                                                    text-align: center;"
                                            >
                                                <a href="{{ route('home') }}" style="font-family: 'Open Sans', sans-serif;
                                                                                    font-weight: 400;
                                                                                    color: #ffffff;
                                                                                    text-decoration: none;"
                                                >
                                                    {{ setting('store_name') }}
                                                </a>
                                            </h5>
                                        @else
                                            <div style="display: flex;
                                                        height: 64px;
                                                        width: 200px;
                                                        align-items: center;
                                                        justify-content: center;
                                                        margin: auto;
                                                        padding: 16px 15px;"
                                            >
                                                <img src="{{ $logo }}" style="max-height: 100%; max-width: 100%;" alt="logo">
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 40px 15px;">
                        <table style="border-collapse: collapse;
                                    min-width: 320px;
                                    max-width: 600px;
                                    width: 100%;
                                    margin: auto;"
                        >
                            @isset($heading)
                            
                            
                                <tr>
                                    <td style="padding: 0;">
                                        <h4 style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 21px;
                                                line-height: 26px;
                                                margin: 0 0 15px;
                                                color: #555555;"
                                        >
                                            {{ $heading }}
                                        </h4>
                                    </td>
                                </tr>
                            @endisset

                            <tr>
                                <td style="padding: 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 16px;
                                                line-height: 26px;
                                                color: #666666;
                                                display: block;"
                                    >
                                        {{ $text }}
                                    </span>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td style="padding: 1em 0 0 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 16px;
                                                line-height: 26px;
                                                color: #666666;
                                                display: block;"
                                    >
                                        Welcome to Modern Packagers, One of the leading eco friendly packaging manufacturers of the country. We not only have presence in India but also export to various other countries. From 2 decades company has gained immense experience in providing unique custom packaging solutions to our customers.
                                    </span>
                                </td>
                            </tr>
                            
                            
                             <tr>
                                <td style="padding: 1em 0 0 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 16px;
                                                line-height: 26px;
                                                color: #666666;
                                                display: block;"
                                    >
                                        <strong>Email Us:</strong>  admin@modernpackagers.in <br><br>
                                        <strong>Call us:</strong> 9779883919 <br><br>
                                        <strong>Hours of operation:</strong> 10 am to 7 Pm Monday to Saturday <br><br>
                                        Modern Packagers <br><br>
                                        Registered Office <br><br>
                                        Plot no 3136, Phase 2, <br><br>
                                        Industrial Area, Chandigarh-160002 <br><br>
                                        India

                                    </span>
                                </td>
                            </tr>
                            
                            
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 15px 0; background: #f1f3f7; text-align: center;">
                        <span style="font-family: 'Open Sans', sans-serif;
                                    font-weight: 400;
                                    font-size: 16px;
                                    line-height: 26px;
                                    display: inline-block;
                                    color: #555555;
                                    padding: 0 15px;"
                        >
                            &copy; {{ date('Y') }}
                            <a target="_blank" href="{{ route('home') }}" style="text-decoration: none; color: #31629f;">
                                {{ setting('store_name') }}.
                            </a>
                            {{ trans('storefront::mail.all_rights_reserved') }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
