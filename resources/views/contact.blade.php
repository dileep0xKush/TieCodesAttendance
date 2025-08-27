@include('include.header')
<style>
    @import url(https://fonts.googleapis.com/css?family=Oxygen:400,300);
    @import url(http://weloveiconfonts.com/api/?family=entypo);

    body {
        margin: 0;
        color: rgba(255, 255, 255, .99);
        font-family: Oxygen;
        background-color: #000;
    }

    #screen {
        position: absolute;
        width: 23em;
        height: 39em;
        max-width: 100%;
        overflow-x: hidden;
    }

    input {
        position: absolute;
        visibility: hidden;
        /**/
    }

    #background {
        position: absolute;
        width: 102%;
        height: 100%;
        background-size: cover;
        background-position: center;
        -webkit-filter: blur(3px);
        z-index: 0;
    }

    label {
        position: absolute;
        left: 0;
        height: 100%;
        width: 100%;
        cursor: pointer;
    }

    .item {
        position: relative;
        float: left;

        width: 100%;
        height: 6em;
        padding: 1px 0;

        background-color: rgba(0, 0, 0, .6);
        /**/
        z-index: 3;
        overflow: hidden;
        -webkit-transition: background-color .7s;
    }

    .portrait {
        position: relative;
        float: left;

        height: 3em;
        width: 3em;

        border-radius: 50%;

        margin: 1.5em;

        background-size: cover;
    }

    .portrait:after {
        content: ' ';
        position: absolute;
        top: -.3em;
        left: -.3em;

        height: 3.5em;
        width: 3.5em;

        border: 1px solid rgba(255, 255, 255, .5);
        border-radius: 50%;
        -webkit-transition: border .3s;
    }

    .details {
        position: relative;
        float: left;
        top: 0;

        width: 55%;
        margin: 1em 0 0 .75em;

        -webkit-transition: top .5s;
    }

    .name,
    .description {
        position: relative;
        float: left;
        clear: left;
        margin: 0;
    }

    .name {
        font-size: 1.5em;
        font-weight: 300;
    }

    .description {
        font-size: .9em;
        color: rgba(255, 255, 255, .8);
    }

    .actions {
        position: absolute;
        top: 7em;

        width: 100%;

    }

    .actions>div {
        font-family: Entypo;
        font-size: 2.1em;

        position: absolute;
        width: 25%;

        color: transparent;
        -webkit-text-stroke-width: .5px;
        -webkit-text-stroke-color: #fff;

        cursor: pointer;
    }

    .actions>div:nth-child(2) {
        left: 30%;
    }

    .actions>div:nth-child(3) {
        left: 60%;
    }

    .actions>div:nth-child(4) {
        left: 90%;
    }

    .actions>div:hover {
        -webkit-text-stroke-width: 0;
        color: #fff !important;
    }

    .info {
        font-size: 100% !important;
    }

    .info:after {
        font-size: 1.7em;
        content: 'i';
        font-family: Consolas !important;

        color: #fff;
        -webkit-text-stroke-width: 0;

        border: 1px solid #fff;
        border-radius: 50%;
        padding: 2px 11px;
    }

    .info:hover:after {
        background-color: rgba(255, 255, 255, .2);
    }

    /* Genreal Interaction */
    .item:hover>.portrait:after {
        border: 1px solid rgba(116, 226, 21, 1);
        box-shadow: 0 0 3px rgba(116, 226, 21, .5);
    }

    input:checked+.item {
        background-color: rgba(0, 0, 0, .3);
        /**/
        padding-top: 0px;
        border-top: 1px solid rgba(255, 255, 255, .1);
        border-bottom: 1px solid rgba(0, 0, 0, .5);
    }

    input:checked+.item>.details {
        top: -6em;
        z-index: 2;
    }

    /* Local Details */

    #chris-lacy {
        background-image: url(https://lh3.googleusercontent.com/-_RbzbA4U-AY/T3le0hEjh5I/AAAAAAAAPbU/H6aRDFguJMY/s207-p-no/profile_pic.png);
    }

    #marq {
        background-image: url(https://lh6.googleusercontent.com/-HM-tr3UEejY/UTkJfpIKB0I/AAAAAAAB4Qw/Auc20I2DW50/s207-p-no/PO8A0788.jpg);
    }

    #Neila {
        background-image: url(https://lh4.googleusercontent.com/-gi7ff5iHmfc/AAAAAAAAAAI/AAAAAAAAAAA/SAt2FLwWnqQ/s170-c-k-no/photo.jpg);
    }

    #Tim {
        background-image: url(https://lh3.googleusercontent.com/-aldjCkivfjM/UiLJGp9uWkI/AAAAAAACZI0/SzF8u1Sn9Yg/s374-no/2010inField.jpg);
    }

    #Ross {
        background-image: url(https://lh5.googleusercontent.com/-ZldUgVhYK2I/Ui5w1xJB-GI/AAAAAAABhyw/CYqAw6qNpdU/s747-no/IMG_4199.JPG);
    }

    #Richard {
        background-image: url(https://lh4.googleusercontent.com/-3hWBW1tTkIs/TrAVPskLAXI/AAAAAAABYxw/tkRaEDCAhPA/w576-h575-no/DSC_0993.jpg);
    }

    #George {
        background-image: url(https://lh5.googleusercontent.com/-1euFoF6_C1c/T9oVScCtEMI/AAAAAAAAoEw/70Mk-gAXts4/w525-h528-no/GT+color3.jpg);
    }

    #Beaufort {
        background-image: url(https://lh6.googleusercontent.com/-GnkJpy0jk60/Tqar4gGdvwI/AAAAAAAA-0w/8qaP8zAm31E/s747-no/P1030524.JPG);
    }

    #Ana {
        background-image: url(https://lh4.googleusercontent.com/-1zxtaYRNh84/AAAAAAAAAAI/AAAAAAAAAAA/7kbNSX3kyZQ/s170-c-k-no/photo.jpg);
    }

    #Mara {
        background-image: url(https://lh6.googleusercontent.com/-iJYfqnaDuxg/Uc-C9u0u70I/AAAAAAAB4wI/TTxYpcfPTW8/s747-no/DSC_5282.JPG);
    }

    /* Local Interactions */
    #contact-1:checked~#background {
        background-image: url(https://lh3.googleusercontent.com/-_RbzbA4U-AY/T3le0hEjh5I/AAAAAAAAPbU/H6aRDFguJMY/s207-p-no/profile_pic.png);
    }

    #contact-2:checked~#background {
        background-image: url(https://lh6.googleusercontent.com/-HM-tr3UEejY/UTkJfpIKB0I/AAAAAAAB4Qw/Auc20I2DW50/s207-p-no/PO8A0788.jpg);
    }

    #contact-3:checked~#background {
        background-image: url(https://lh4.googleusercontent.com/-gi7ff5iHmfc/AAAAAAAAAAI/AAAAAAAAAAA/SAt2FLwWnqQ/s170-c-k-no/photo.jpg);
    }

    #contact-4:checked~#background {
        background-image: url(https://lh3.googleusercontent.com/-aldjCkivfjM/UiLJGp9uWkI/AAAAAAACZI0/SzF8u1Sn9Yg/s374-no/2010inField.jpg);
    }

    #contact-5:checked~#background {
        background-image: url(https://lh5.googleusercontent.com/-ZldUgVhYK2I/Ui5w1xJB-GI/AAAAAAABhyw/CYqAw6qNpdU/s747-no/IMG_4199.JPG);
    }

    #contact-6:checked~#background {
        background-image: url(https://lh4.googleusercontent.com/-3hWBW1tTkIs/TrAVPskLAXI/AAAAAAABYxw/tkRaEDCAhPA/w576-h575-no/DSC_0993.jpg);
    }

    #contact-7:checked~#background {
        background-image: url(https://lh5.googleusercontent.com/-1euFoF6_C1c/T9oVScCtEMI/AAAAAAAAoEw/70Mk-gAXts4/w525-h528-no/GT+color3.jpg);
    }

    #contact-8:checked~#background {
        background-image: url(https://lh6.googleusercontent.com/-GnkJpy0jk60/Tqar4gGdvwI/AAAAAAAA-0w/8qaP8zAm31E/s747-no/P1030524.JPG);
    }

    #contact-9:checked~#background {
        background-image: url(https://lh4.googleusercontent.com/-1zxtaYRNh84/AAAAAAAAAAI/AAAAAAAAAAA/7kbNSX3kyZQ/s170-c-k-no/photo.jpg);
    }

    #contact-10:checked~#background {
        background-image: url(https://lh6.googleusercontent.com/-iJYfqnaDuxg/Uc-C9u0u70I/AAAAAAAB4wI/TTxYpcfPTW8/s747-no/DSC_5282.JPG);
    }
</style>
<div id="screen">
    <!-- Backstage Controlls -->
    <input type="radio" name="contatcs" id="contact-1">
    <div class="item">
        <div class="portrait" id="chris-lacy"></div>
        <div class="details">
            <p class="name">Chris Lacy</p>
            <p class="description">Developer</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-1"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-10">
    <div class="item">
        <div class="portrait" id="Mara"></div>
        <div class="details">
            <p class="name">Mara Mascaro</p>
            <p class="description">Video Editor</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-10"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-2">
    <div class="item">
        <div class="portrait" id="marq"></div>
        <div class="details">
            <p class="name">Marques Brownlee</p>
            <p class="description">Producer</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-2"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-3">
    <div class="item">
        <div class="portrait" id="Neila"></div>
        <div class="details">
            <p class="name">Neila Rey</p>
            <p class="description">Fitness Community</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-3"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-4">
    <div class="item">
        <div class="portrait" id="Tim"></div>
        <div class="details">
            <p class="name">Tim O'Reilly</p>
            <p class="description">CEO, O'Reilly Media</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-4"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-9">
    <div class="item">
        <div class="portrait" id="Ana"></div>
        <div class="details">
            <p class="name">Ana Svanadze</p>
            <p class="description">Patriot</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-9"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-5">
    <div class="item">
        <div class="portrait" id="Ross"></div>
        <div class="details">
            <p class="name">Derek Ross</p>
            <p class="description">Systems Administrator</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-5"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-6">
    <div class="item">
        <div class="portrait" id="Richard"></div>
        <div class="details">
            <p class="name">Richard Branson</p>
            <p class="description">Founder of Virgin Group</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-6"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-7">
    <div class="item">
        <div class="portrait" id="George"></div>
        <div class="details">
            <p class="name">George Takei</p>
            <p class="description">Come on</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-7"></label>
    </div>

    <input type="radio" name="contatcs" id="contact-8">
    <div class="item">
        <div class="portrait" id="Beaufort"></div>
        <div class="details">
            <p class="name">François Beaufort</p>
            <p class="description">Happiness Evangelist</p>
            <div class="actions">
                <div class="mail">&#9993;</div>
                <div class="text">&#59168;</div>
                <div class="call">&#128222;</div>
                <div class="info"></div>
            </div>
        </div>
        <label for="contact-8"></label>
    </div>

    <div id="background"></div>
</div>

@include('include.footer')
