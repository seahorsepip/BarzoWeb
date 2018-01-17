<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="container wrapper">
    <div class="pub-background"><img src="<?php echo $bar['photos']['profile_image']; ?>"></div>
    <div class="pub-wrapper">
        <h1><?php echo $bar["name"]; ?></h1>
        <p><?php echo $bar['description']; ?></p>
        <h4>Pictures</h4>
        <?php if (isset($bar['photos']['images'])) : ?>
            <?php foreach ($bar['photos']['images'] as $image) : ?>
                <img src="<?php echo $image; ?>" class="rounded">
            <?php endforeach; ?>
        <?php endif; ?>
        <h4>Most voted music</h4>
        <table class="table table-striped table-bordered votes-wrapper">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Artist</th>
                <th>Album</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="alert alert-dismissible alert-info votes-alert">
            There are currently no votes or the bar doesn't offer our music service.
        </div>
        <script>
            let wrapper = document.querySelectorAll('.votes-wrapper')[0];
            let alert = document.querySelectorAll('.votes-alert')[0];
            //fetch('http://music.maatwerk.works/api/votes?userId=<?php echo $bar["id"]; ?>')
            fetch('http://music.maatwerk.works/api/votes')
                .then(response => response.json())
                .then(votes => {
                    if (votes.length) {
                        wrapper.style.display = 'table';
                        alert.style.display = 'none';
                        votes.forEach((vote, index) => {
                            let el = document.createElement("tbody");
                            el.innerHTML = `<tr>
                                                <td>${++index}</td>
                                                <td>${vote.name}</td>
                                                <td>${vote.artist}</td>
                                                <td>${vote.album}</td>
                                            </tr>`;
                            wrapper.children[1].appendChild(el.children[0]);
                        })
                    } else {
                        wrapper.style.display = 'none';
                        alert.style.display = 'block';
                    }
                });
        </script>
        <h4>Location</h4>
        <iframe height="320"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDmAI4g7ugKkgsDAbZBG33ad7QvICHx1Kk&q=<?php echo $bar["address"]; ?>,&nbsp;<?php echo $bar["city"]; ?>"></iframe>
        <!--
        <h4>QRCode</h4>
        <div class="qrcode"></div>
        <script>
            new QRCode(document.querySelectorAll('.qrcode')[0], 'http://music.maatwerk.works/<?php echo $bar["id"]; ?>');
        </script>-->
    </div>
</div>