<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     
    <link rel="stylesheet" href="{{ url('/print/base.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/print/fancy.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/print/main.css') }}" />
    <script src="{{ url('/print/compatibility.min.js') }}"></script>
    <script src="{{ url('/print/theViewer.min.js') }}"></script>
    <script>
        try {
            theViewer.defaultViewer = new theViewer.Viewer({});
        } catch (e) {}
    </script>
    <title></title>
</head>

<body>
    <div id="sidebar">
        <div id="outline">
        </div>
    </div>
    <div id="page-container">
        <div id="pf1" class="pf w0 h0" data-page-no="1">
            <div class="pc pc1 w0 h0">
                <img class="bi x0 y0 w1 h1" alt="" src="{{ url('/print/bg1.png')}}" />