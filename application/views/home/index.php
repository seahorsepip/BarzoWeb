<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="container-fluid wrapper">
    <!--
    <div class="row">
        <div class="col">
            <br>
            <br>
            <h4>Barzo music app</h4>
            <p>Root L0phtCrack access /dev/null server stdio.h null system tdo python baz bar strlen continue
                worm long
                salt packet sniffer. Hash throw mailbomb then break back door perl emacs gc overflow sudo gobble
                hash
                bang nak. Eof blob spoof ack cd suitably small values syn fatal hello world it's a feature.</p>
            <img src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png"
                 style="width: 200px;">
        </div>
        <div class="col">
            <br>
            <br>
            <h4>Join</h4>
            <p>Root L0phtCrack access /dev/null server stdio.h null system tdo python baz bar strlen continue
                worm long
                salt packet sniffer. Hash throw mailbomb then break back door perl emacs gc overflow sudo gobble
                hash
                bang nak. Eof blob spoof ack cd suitably small values syn fatal hello world it's a feature.</p>
            <br>
            <button class="btn btn-primary">Join Barzo!</button>
        </div>
        <div class="col"></div>
    </div>-->
    <div class="row">
        <div class="col-md-4 col-lg-3 col-xl-2 filter-wrapper">
            <img src="https://i.imgur.com/Nop5Xjo.png" class="logo">
            <form class="form-search">
                <input class="form-control" type="text" placeholder="Search">
                <button class="btn btn-secondary" type="submit">Search</button>
            </form>
            <h5>Stad</h5>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city" checked>
                    Eindhoven
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city">
                    Amsterdam
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city">
                    Utrecht
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city">
                    Breda
                </label>
            </div>
            <h5>Muziek</h5>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city" checked>
                    Pop
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city" checked>
                    House
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city">
                    Electro
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="city">
                    Country
                </label>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 col-xl-10 bars-wrapper">
            <div class="card-columns"></div>
            <script type="application/javascript">
                let wrapper = document.querySelectorAll('.card-columns')[0];
                fetch('http://maatwerk.works/api/bars')
                    .then(response => response.json())
                    .then(bars => {
                        //Code from hell for testing purposes
                        let a = bars[0];
                        let b = bars[1];
                        bars.push(a);
                        bars.push(a);
                        bars.push(a);
                        bars.push(a);
                        bars.push(b);
                        bars.push(b);
                        bars.push(b);
                        bars.push(b);
                        return bars;
                    })
                    .then(bars => bars.forEach(bar => {
                        let el = document.createElement("div");
                        el.innerHTML = `<div class="card">
                                            <img class="card-img-top"
                                                 src="${bar.photos.profile_image}">
                                            <div class="card-body">
                                                <h4 class="card-title">${bar.name}</h4>
                                                <p class="card-text">${bar.description}</p>
                                                <a href="/bars/${bar.id}" class="btn btn-primary">More info</a>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">${bar.address}, ${bar.city}</p>
                                            </div>
                                        </div>`;
                        wrapper.appendChild(el.children[0]);
                    }));
            </script>
        </div>
    </div>
</div>