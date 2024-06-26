<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
    font-family: Roboto;
}

.certificate-container {
    padding: 50px;
    width: 1024px;
}
.certificate {
    border: 20px solid #0C5280;
    padding: 25px;
    height: 600px;
    position: relative;
}

.certificate:after {
    content: '';
    top: 0px;
    left: 0px;
    bottom: 0px;
    right: 0px;
    position: absolute;
    background-image: url(https://image.ibb.co/ckrVv7/water_mark_logo.png);
    background-size: 100%;
    z-index: -1;
}

.certificate-header > .logo {
    width: 80px;
    height: 80px;
}

.certificate-title {
    text-align: center;    
}

.certificate-body {
    text-align: center;
}

h1 {

    font-weight: 400;
    font-size: 48px;
    color: #0C5280;
}

.student-name {
    font-size: 24px;
}

.certificate-content {
    margin: 0 auto;
    width: 750px;
}

.about-certificate {
    width: 380px;
    margin: 0 auto;
}

.topic-description {

    text-align: center;
}









    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate">
            <div class="water-mark-overlay"></div>
            <div class="certificate-header">
                <img src="https://rnmastersreview.com/img/logo.png" class="logo" alt="">
            </div>
            <div class="certificate-body">
               
                <p class="certificate-title"><strong>Beesquad</strong></p>
                <h1>Certificate of Completion</h1>
                <p class="student-name">{{$user_name}}</p>
                <div class="certificate-content">
                    <div class="about-certificate">
                        <p>
                    Đã hoàn thành khoá học <strong>{{$course_name}}</strong>
                    </p>
                    </div>
                    {{-- <p class="topic-title">
                        The Topic consists of [hours] Continuity hours and includes the following:
                    </p>
                    <div class="text-center">
                        <p class="topic-description text-muted">Contract adminitrator - Types of claim - Claim Strategy - Delay analysis - Thepreliminaries to a claim - The essential elements to a successful claim - Responses - Claim preparation and presentation </p>
                    </div> --}}
                </div>
                <div class="certificate-footer text-muted">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Beesquad</p>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        Website:Beesquad.com.vn
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        Công Ty Giáo Dục
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>