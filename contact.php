<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aanmeldformulier — missKARIN</title>
  <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>

<!-- ══════════ HEADER ══════════ -->
<header>
  <nav>
    <a href="index.php" class="logo"><img src="assets/img/logo.jpg" alt="missKARIN Logo"></a>
    <ul class="nav-links">0?5
      <li><a href="index.php#home">Home</a></li>
      <li><a href="index.php#over-misskarin">Over missKARIN</a></li>
      <li><a href="index.php#inburgering">Inburgering</a></li>
      <li><a href="index.php#integratie">Integratie</a></li>
      <li><a href="index.php#begeleiding">Begeleiding</a></li>
      <li><a href="contact.php" style="color:var(--teal); border-bottom:2px solid var(--teal);">Contact</a></li>
    </ul>
  </nav>
</header>
  
 <div class="page-wrapper">

  <!-- Left: image + overlay text -->
  <div class="form-bg">
    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=900&fit=crop&auto=format"
         alt="missKARIN taalles"
         onerror="this.style.display='none'">
    <div class="form-bg-overlay">
      <h2>Aanmeld<br>formulier</h2>
      <p>Vul het formulier in en wij nemen zo snel mogelijk contact met u op om uw aanmelding te bespreken.<br><br>
      Het intakegesprek is altijd <strong style="color:#fff;">gratis</strong>.</p>
    </div>
  </div>

  <!-- Right: form -->
  <div class="form-side">
    <h1>Aanmeldformulier</h1> 

    <form action="submit.php" id="aanmeld-form" novalidate method="post">

      <div class="form-group">
         <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" placeholder="Voor- en achternaam" required>
      </div>

      <div class="form-group">
        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" placeholder="uw@email.nl" required>
      </div>

      <div class="form-group">
        <label for="telefoon">Telefoonnummer:</label>
        <input type="tel" id="telefoon" name="telefoon" placeholder="06 – 0000 0000">
      </div>

      <div class="form-row-3">
        <div class="form-group">
          <label for="straat">Adres:</label>
          <input type="text" id="straat" name="straat" placeholder="Straatnaam">
        </div>
        <div class="form-group">
          <label for="huisnummer">Huisnr.:</label>
          <input type="text" id="huisnummer" name="huisnummer" placeholder="12A">
        </div>
        <div class="form-group">
          <label for="postcode">Postcode:</label>
          <input type="text" id="postcode" name="postcode" placeholder="1234 AB">
        </div>
      </div>

      <div class="form-group">
        <label for="plaats">Plaats:</label>
        <input type="text" id="plaats" name="plaats" placeholder="Amsterdam">
      </div>

      <div class="form-group">
        <label for="cursus">Gewenste cursus:</label>
        <select id="cursus" name="cursus">
          <option value="">— Selecteer een cursus —</option>
          <option value="inburgering">Inburgering (complete cursus)</option>
          <option value="knm">KNM Module</option>
          <option value="dna">DNA Module</option>
          <option value="taalles-a1">Nederlandse taalles A1</option>
          <option value="taalles-a2">Nederlandse taalles A2</option>
          <option value="taalles-b1">Nederlandse taalles B1</option>
          <option value="taalles-b2">Nederlandse taalles B2</option>
          <option value="examentraining">Examentraining</option>
          <option value="priveles">Privéles</option>
          <option value="in-company">In-company training</option>
          <option value="advies">Gratis adviesgesprek</option>
        </select>
      </div>

      <div class="form-group">
        <label for="bericht">Bericht / aanvullende informatie:</label>
        <textarea id="bericht" name="bericht" placeholder="Vertel ons meer over uw situatie of stel een vraag..."></textarea>
      </div>

      <div class="form-submit">
        <button type="submit">Versturen</button>
      </div>
    </form>

    <!-- Thank-you state -->
    <div id="thank-you">
      <div class="checkmark">✅</div>
      <h3>Bedankt voor uw aanmelding!</h3>
      <p>We nemen zo snel mogelijk contact met u op.</p>
    </div>

    <a href="index.php" class="back-link">← Terug naar de hoofdpagina</a>
  </div>

</div>

<!-- ══════════ FOOTER ══════════ -->
<footer>
  © 2024 missKARIN — Nederlandse taalles &amp; inburgering &nbsp;|&nbsp; info@misskarin.nl
</footer>

<script>
  (function () {
    const form = document.getElementById('aanmeld-form');
    const thanks = document.getElementById('thank-you');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
      e.preventDefault();
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalLabel = submitBtn ? submitBtn.textContent : '';
      if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Versturen…'; }

      try {
        const res = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: { 'Accept': 'application/json' }
        });
        const data = await res.json().catch(() => ({}));

        if (res.ok && data.ok) {
          form.style.display = 'none';
          if (thanks) thanks.style.display = 'block';
        } else {
          alert(data.error || 'Er ging iets mis bij het verzenden. Probeer het opnieuw.');
          if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = originalLabel; }
        }
      } catch (err) {
        alert('Verbinding mislukt. Controleer uw internetverbinding en probeer opnieuw.');
        if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = originalLabel; }
      }
    });
  })();
</script>

</body>
</html>
