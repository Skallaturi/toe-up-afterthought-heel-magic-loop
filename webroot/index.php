<?php
/** @noinspection NonAsciiCharacters */
/** @noinspection SpellCheckingInspection */

// input variable
/** Masker per 10 cm */
$m = 10.5;

/** Rækker per 10 cm */
$r = 10.5;

/** Skostørrelse */
$str = 42;

/** Til bred fod? */
$bred = true;

// hent variable fra server
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $m = $_POST["m"];
    $r = $_POST["r"];
    $str = $_POST["str"];
    $bred = key_exists("bred", $_POST);
}

// mellemberegninger

$l = 2 * ($str - 2) / 3;
$o = $l * 0.9;
if ($bred) {
    $o = $l;
}

$mtotal = floor($m / 10 * $o);
$mtotal = $mtotal - ($mtotal % 8); //todo: afkobl bredden af tåen fra ant udt.
$mtå = $mtotal / 2;
$mtåhalv = $mtå / 2;
$antUdt = $mtå / 4;
$tåL = ($antUdt * 2) * (10 / $r); // todo: roof eller floor?
$førHælL = $l - $tåL;

?>

<h1>Tå-op sokker med afterthought heel på magic loop v0,1:</h1>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

    <p>
    <h4>Strikkefasthed</h4>
    <label>Masker pr. 10 cm:
        <input type="number" step="any" name="m" value=<?php echo $m; ?> required>
    </label>
    <label>Rækker pr. 10 cm:
        <input type="number" step="any" name="r" value=<?php echo $r; ?> required>
    </label>

    <p>
    <h4>Fod</h4>
    <label>Skostørrelse:
        <input type="number" min=30 max=47 name="str" value=<?php echo $str; ?> required>
    </label>
    <label>Bred fod?
        <input type="checkbox" name="bred" <?php if ($bred) {
            echo "checked";
        } ?> >
    </label>

    <p>
        <input type="submit" name="submit" value="Beregn">
    </p>
</form>
<hr/>
<div>
    <?php if ($mtå < 8) {
        echo "Den størrelse og strikkefasthed duer ikke sammen.";
    } else {
        echo "<h2>Tå</h2>
    Slå $mtå masker op med 8-taller om pinden, så der er $mtåhalv masker på hver pind.<br>
    <strong>omgang 1:</strong> strik alle masker r<br>
    <strong>omgang 2:</strong> *1r 1v-udt (r til 2 m før slutn. af pind) 1h-udt 1r gentag fra * en gang mere.<br>

    Gentag <strong>omgang 1 og 2</strong> " . ($antUdt - 1) . " gange mere, altså $antUdt gange i alt. $mtotal masker i alt.<br>

    <h2>Fod</h2>
    Hvis der ønskes tofarvede strømper skiftes der nu til hovedfarven.<br>
    Strik nu det ønskede ribmønster på den ene pind (oversiden af foden) og ret på den anden pind (undersiden af foden) til arb måler ". round($førHælL) . " cm.<br>

    <h2>Forberedelse til hæl</h2>
    Strik ribmønster den første pind ud. Tag så et stykke restgarn af ca samme tykkelse som arbejdsgarnet
    (brug gerne bomuld til dette - jo glattere jo bedre) og strik med dette i stedet for arbejdsgarnet.<br>
    Hæft ikke enderne fast. Strik til omg. start, dvs " . ($mtotal/2) . " masker, og flyt så disse masker tilbage på venstre pind.<br>
    Strik nu de samme masker igen, men med arbejdsgarnet.<br>

    <h2>Skaft</h2>
    Herefter strikkes ribmønster hele omgangen rundt indtil skaftet har den ønskede længde. Luk elastisk af.

    <h2>Hæl</h2>
    Saml et ben op af hver af de " . ($mtotal / 2) . " masker over restgarnet og " . ($mtotal / 2) . " masker under restgarnet,
    således at restgarnet er imellem pindene. Pil restgarnet ud.<br>
    Nu strikkes hælen over disse masker med den ønskede farve.<br>
    <strong>omgang:</strong> hele omgangen strikkes ret<br>
    <strong>omgang:</strong> *1r 1v-indt (r til 2 m før slutn. af pind) 1h-indt 1r gentag fra * en gang mere.<br>
    Gentag disse to pinde indtil der er $mtå masker tilbage, altså $mtåhalv masker på hver pind.<br>
    Luk af med kitchener stitch.";
    }
    ?>
</div>