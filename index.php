<?php
require __DIR__ . '/assets/includes/conn.php';

try {
  $courses = $conn->query('SELECT id, name, price, description FROM taallessen ORDER BY id')
    ->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $courses = [];
  error_log('DB query failed: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>missKARIN — Nederlandse Taalles & Inburgering</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <!-- ══════════ HEADER ══════════ -->
  <header>
    <nav>
      <a href="#home" class="logo"><img src="assets/img/logo.jpg" alt="missKARIN Logo"></a>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#over-misskarin">Over missKARIN</a></li>
        <li><a href="#inburgering">Inburgering</a></li>
        <li><a href="#integratie">Integratie</a></li>
        <li><a href="#begeleiding">Begeleiding</a></li>
        <li><a href="contact.php">Online leseen</a></li>
        <li><a href="login.php" class="btn" style="padding: 6px 14px; font-size: 0.85rem; margin-left: 10px;">CMS Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- ══════════ HERO ══════════ -->
  <section id="home">
    <div class="container">
      <div class="hero-grid">
        <div class="hero-text">
          <h1>WELKOM<br>bij miss<span>KARIN</span></h1>
          <ul class="hero-list">
            <li>Persoonlijk en betaalbaar</li>
            <li>Kwalitatief bewezen aanpak</li>
            <li>Kleine klassen, flexibele tijden</li>
            <li>ONA &amp; KNM combinatie mogelijk</li>
            <li>Enthousiaste, erkende trainers</li>
            <li>Examengarantie inbegrepen</li>
            <li>Milieuvriendelijke aanpak</li>
          </ul>
          <a href="contact.php" class="btn">Neem contact op</a>
        </div>
        <div class="hero-img">
          <img class="img-fill" src="assets/img/website foto miss Karin-8953.jpg" alt="missKARIN groepsfoto"
            onerror="this.outerHTML='<div class=\'placeholder\'>Groepsfoto missKARIN</div>'">
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════ OVER MISSKARIN ══════════ -->
  <section id="over-misskarin" style="padding:52px 20px; background:#fff;">
    <div class="container">
      <h2 class="section-title">Over missKARIN</h2>
      <p class="section-subtitle">
        missKARIN biedt kwalitatieve Nederlandse taallessen en inburgeringscursussen aan voor mensen die
        Nederland beter willen leren kennen. Ons team van ervaren, enthousiaste docenten helpt u stap voor stap
        vooruit — op uw eigen tempo en niveau.<br><br>
        Heeft u vragen of weet u niet hoe het NT2-traject in zijn werk gaat? Neem gerust contact op voor een
        <strong>gratis adviesgesprek</strong>. We vertellen u alles over de mogelijkheden.
      </p>

      <div class="promo-video-container">
        <video controls class="promo-video">
          <source src="assets/img/MissKarin PROMO FINAL 01.mp4" type="video/mp4">
          Uw browser ondersteunt deze video niet.
        </video>
      </div>
    </div>
  </section>

  <!-- ══════════ AANBOD ══════════ -->
  <div class="teal-band" style="border-top:1px solid rgba(0,0,0,0.05);">
    <h2>AANBOD</h2>
  </div>
  <section id="inburgering" style="padding:52px 20px;">
    <div class="container">
      <p class="section-subtitle" style="margin-bottom:30px;">
        Heeft u vragen over de Nederlandse taal of weet u niet wat het NT2-traject inhoudt?<br>
        Neem contact op voor meer info — we vertellen u alles over onze diensten.
      </p>
      <div class="services-grid">
        <div class="service-card">
          <h3>Gratis Advies</h3>
          <p>Wij adviseren u gratis welk inburgeringstraject het beste bij u past. We kijken samen naar uw
            situatie en helpen u beslissen welke stappen u moet nemen om te inburgeren in Nederland.</p>
        </div>
        <div class="service-card">
          <h3>Inburgeringslessens</h3>
          <p>Wij bieden erkende inburgeringscursussen aan op maat. De school voldoet aan de kwaliteitseisen
            van de Rijksoverheid. In kleine groepen werken deelnemers doelgericht naar het gewenste
            taalniveau.</p>
        </div>
        <div class="service-card">
          <h3>KNM Module</h3>
          <p>Kennis van de Nederlandse Maatschappij. Alles wat u moet weten om te integreren in Nederland en
            succesvol aan de samenleving deel te nemen. Na het examen kunt u een erkend diploma halen.</p>
        </div>
        <div class="service-card">
          <h3>ONA Module</h3>
          <p>Oriëntatie op de Nederlandse Arbeidsmarkt. Speciaal voor wie wil werken in Nederland en
            loopbaanmogelijkheden wil verkennen. We begeleiden u bij uw zoektocht naar passend werk.</p>
        </div>
        <div class="service-card">
          <h3>Examentraining</h3>
          <p>Als u bijna klaar bent met uw inburgering bieden wij een speciaal examentrainingsprogramma.
            Lezen, Schrijven, Spreken en Luisteren — zodat u optimaal voorbereid bent voor het examen.</p>
        </div>
        <div class="service-card">
          <h3>Privéles</h3>
          <p>Wilt u meer individuele aandacht? Een privéles is ideaal. Spreken, lezen, schrijven — kies zelf
            wat u wilt verbeteren. Volledig op uw eigen tempo en niveau, met een persoonlijke trainer.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════ GARANTIES ══════════ -->
  <div class="teal-band">
    <h2>GARANTIES</h2>
  </div>
  <section id="garanties">
    <div class="container">
      <div class="guarantees-grid">
        <div class="guarantee-item">
          <span class="gicon">📶</span>
          <p>100% examengarantie</p>
        </div>
        <div class="guarantee-item">
          <span class="gicon">🎓</span>
          <p>Gratis coaching</p>
        </div>
        <div class="guarantee-item">
          <span class="gicon">👤</span>
          <p>Persoonlijke begeleiding</p>
        </div>
        <div class="guarantee-item">
          <span class="gicon">📋</span>
          <p>Erkend diploma</p>
        </div>
        <div class="guarantee-item">
          <span class="gicon">💻</span>
          <p>Online lesmateriaal</p>
        </div>
        <div class="guarantee-item">
          <span class="gicon">🌿</span>
          <p>Duurzame aanpak</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════ IMAGE STRIP ══════════ -->
  <div class="img-strip">
    <img src="assets/img/website foto miss Karin-8947.jpg" alt="missKARIN les in actie"
      onerror="this.outerHTML='<div style=\'width:100%;height:100%;background:#b2ddd8;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;\'>Video / Sfeerfoto</div>'">
    <div class="img-strip-caption">Ontdek onze lessen en de sfeer bij missKARIN</div>
  </div>

  <!-- ══════════ PRIJZEN ══════════ -->
  <section id="prijzen">
    <div class="container">
      <h2 class="section-title">PRIJZEN</h2>
      <p class="section-subtitle">
        Het adviesgesprek/aanmeldgesprek is gratis.<br>
        Daarna weet u wat het beste bij uw situatie past.
      </p>
      <div class="prices-grid">

        <!-- Inburgering -->
        <div class="price-card">
          <h3>Inburgering</h3>
          <div class="price-tag">Complete cursus</div>
          <p>Volledige inburgeringscursus inclusief taalles, KNM &amp; DNA modules en examenvoorbereiding.
            Erkend door de Rijksoverheid.</p>
          <ul class="price-features">
            <li>Taalles op niveau (A1–B1)</li>
            <li>KNM &amp; DNA modules</li>
            <li>Examenvoorbereiding</li>
            <li>Persoonlijke begeleiding</li>
            <li>Examengarantie</li>
          </ul>
          <div class="price-amount">€ 1.095,-</div>
          <div class="price-note">per module · inclusief lesmateriaal</div>
          <a href="contact.php" class="btn">Aanmelden</a>
        </div>

        <!-- ONA of KNM -->
        <div class="price-card">
          <h3>ONA of KNM Module</h3>
          <div class="price-tag">Losse module</div>
          <p>Volg alleen de ONA- of KNM-module. Perfect als u al een deel van het inburgeringstraject hebt
            afgerond.</p>
          <ul class="price-features">
            <li>Volledige module-inhoud</li>
            <li>Groepslessen</li>
            <li>Examengarantie</li>
            <li>Studiemateriaal inbegrepen</li>
          </ul>
          <div class="price-amount">€ 1.295,-</div>
          <div class="price-note">per module · inclusief lesmateriaal</div>
          <a href="contact.php" class="btn">Aanmelden</a>
        </div>

        <!-- Privéles -->
        <div class="price-card">
          <h3>Privéles of Examentraining</h3>
          <div class="price-tag">Individueel / per uur</div>
          <p>Voor wie individuele begeleiding wil of intensief wil trainen voor het examen. Op uw eigen tempo
            en niveau.</p>
          <ul class="price-features">
            <li>1-op-1 begeleiding</li>
            <li>Flexibele tijden</li>
            <li>Gericht op uw zwakke punten</li>
            <li>Spreken, lezen of schrijven</li>
          </ul>
          <div class="price-amount">€ 45,-</div>
          <div class="price-note">per uur</div>
          <a href="contact.php" class="btn">Aanmelden</a>
        </div>

      </div>

      <!-- In-company -->
      <div class="inco-box">
        <h3>In-company trainingen</h3>
        <p>Voor bedrijven met internationale medewerkers bieden wij maatwerk taaltrainingen aan op locatie. Neem
          contact op via mail of telefoon om de mogelijkheden te bespreken.</p>
        <a href="contact.php" class="btn">Neem contact op</a>
      </div>
    </div>
  </section>

  <!-- ══════════ NEDERLANDSE TAALLES ══════════ -->
  <div class="teal-band">
    <h2>NEDERLANDSE TAALLES</h2>
    <p>Nieuwe groepen starten in augustus en februari!</p>
  </div>
  <section id="integratie" style="padding:0;">

    <!-- Introductie split -->
    <div class="taalles-split">
      <div class="split-img">
        <img class="img-fill" src="assets/img/website foto miss Karin-8918.jpg" alt="Klassikale taalles"
          style="min-height:320px;"
          onerror="this.outerHTML='<div class=\'placeholder\' style=\'min-height:320px;\'>Taalles klassikaal</div>'">
      </div>
      <div class="split-text">
        <h3>Nederlandse taallessen op maat</h3>
        <p>Wij bieden kwalitatieve taalcursussen voor niet-moedertaalsprekers op niveau A1 t/m CNaVT. Onze
          lessen worden gegeven door enthousiaste, erkende docenten in kleine groepen — zodat u altijd de
          aandacht krijgt die u nodig heeft.<br><br>
          Weet u niet welke les bij u past? We starten altijd met een gratis intakegesprek om het juiste
          niveau te bepalen.</p>
      </div>
    </div>

    <!-- Niveau grid -->
    <div class="taalles-split" style="border-top:1px solid var(--border);">
      <div class="split-img">
        <img class="img-fill" src="assets/img/website foto miss Karin-8891.jpg" alt="Niveau taalles"
          style="min-height:380px;"
          onerror="this.outerHTML='<div class=\'placeholder\' style=\'min-height:380px;\'>Taalles niveaus foto</div>'">
      </div>
      <div class="niveau-table">
        <h3>Nederlandse taallessen op niveau</h3>
        <?php if (empty($courses)): ?>
          <div class="niveau-row">
            <span class="niveau-label">Geen cursussen beschikbaar</span>
          </div>
          <?php else: foreach ($courses as $c):
            $name  = htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8');
            $desc  = htmlspecialchars($c['description'], ENT_QUOTES, 'UTF-8');
            $price = (float)$c['price'];
            $priceLabel = $price > 0
              ? ' — € ' . number_format($price, 2, ',', '.')
              : '';
          ?>
            <div class="niveau-row">
              <span class="niveau-label" title="<?= $desc ?>"><?= $name ?><?= $priceLabel ?></span>
              <a href="contact.php?cursus=<?= urlencode($c['name']) ?>" class="niveau-btn">Aanmelden</a>
            </div>
        <?php endforeach;
        endif; ?>
        <div class="schedule-box">
          <strong>Ochtend</strong> van 9:00 tot 12:00 uur<br>
          <strong>Middag</strong> van 13:00 tot 16:00 uur<br>
          <strong>Avond</strong> van 18:00 tot 21:00 uur
        </div>
      </div>
    </div>

  </section>

  <!-- ══════════ BEGELEIDING NAAR WERK ══════════ -->
  <div class="teal-band">
    <h2>BEGELEIDING NAAR WERK</h2>
  </div>
  <section id="begeleiding" style="padding:52px 20px;">
    <div class="container">
      <div class="begel-grid">
        <div class="begel-imgs">
          <div class="begel-img">
            <img class="img-fill" src="assets/img/website foto miss Karin-8951.jpg"
              alt="Werkbegeleiding groep"
              onerror="this.outerHTML='<div class=\'placeholder\'>Groepsfoto Werkbegeleiding</div>'">
          </div>
          <div class="begel-img">
            <img class="img-fill" src="assets/img/website foto miss Karin-8904.jpg"
              alt="Partner werkbegeleiding"
              onerror="this.outerHTML='<div class=\'placeholder\'>Werkgever Partner</div>'">
          </div>
        </div>
        <div class="begel-text">
          <h3>Van taal naar werk</h3>
          <p>Na het behalen van uw taaldiploma helpen wij u ook bij het vinden van een passende baan. Wij
            werken samen met werkgevers en bemiddelingsbureaus om u de beste kansen op de Nederlandse
            arbeidsmarkt te bieden.<br><br>
            Onze begeleiders kennen de weg en staan klaar om u te ondersteunen bij elke stap — van cv
            schrijven tot sollicitatiegesprek.</p>
          <a href="contact.php" class="btn" style="margin-top:4px;">Meer informatie</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════ CONTACT ══════════ -->
  <section id="contact">
    <div class="container">
      <h2 class="section-title">Contact</h2>
      <p class="section-subtitle">Heeft u nog vragen? Neem dan contact met ons op.</p>
      <div class="contact-grid">
        <div>
          <div class="map-placeholder">📍 Kaart — Locatie missKARIN</div>
          <div class="contact-info-box">
            <h3>NEEM CONTACT OP</h3>
            <p>
              📍 Voorbeeldstraat 12, Amsterdam<br>
              📞 020 – 000 0000<br>
              ✉️ info@misskarin.nl<br><br>
              Bereikbaar:<br>
              Maandag t/m vrijdag: 09:00–17:00
            </p>
          </div>
        </div>
        <div class="contact-cta-box">
          <p>Wilt u zich aanmelden voor een cursus of heeft u een vraag?<br>Vul ons formulier in en wij nemen
            zo snel mogelijk contact met u op.</p>
          <a href="contact.php" class="btn" style="font-size:1rem; padding:14px 38px;">Ga naar het
            formulier</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ══════════ FOOTER ══════════ -->
  <footer>
    <div class="footer-inner">
      <div class="footer-brand">
        <p>missKARIN</p>
        <p>Nederlandse taalles &amp; inburgering</p>
        <p style="margin-top:6px;">📍 Amsterdam &nbsp;|&nbsp; ✉️ info@misskarin.nl</p>
      </div>
      <div class="footer-logos">
        <div class="logo-badge">ENT</div>
        <div class="logo-badge">VU Academy</div>
        <div class="logo-badge">NT2 Erkend</div>
      </div>
    </div>
    <div class="footer-bottom">
      © 2024 missKARIN — Alle rechten voorbehouden
    </div>
  </footer>

</body>

</html>
