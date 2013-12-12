<?php 

drupal_add_library('system', 'ui');
drupal_add_library('system', 'ui.widget');
drupal_add_library('system', 'ui.mouse');
drupal_add_library('system', 'ui.slider');

$results['richpercent'] = 21;
$results['richtimes'] = 24;
$income = 0;
$country = "GBR";
$adult = 1;
$child = 0;
/* 
 * Calculator: Template theme used in summerton
 *
 *
 */
?>
<div class="container calculator">
    <div class="content-header">
        <h1> How rich am I?</h1>
    </div>
    <div class="container justify grey">
        <div class="container inline">
            <label for="country">Location</label>
            <select name="country" onChange="selectcurrency(this.value)" id="calc-howrich-country" class="calcselect">
                    <option value="AU"> Australia </option>
                    <option value="AT"> Austria </option>
                    <option value="BE"> Belgium </option>
                    <option value="CA"> Canada </option>
                    <option value="CL"> Chile </option>
                    <option value="CZ"> Czech Republic </option>
                    <option value="DK"> Denmark </option>
                    <option value="EE"> Estonia </option>
                    <option value="FI"> Finland </option>
                    <option value="FR"> France </option>
                    <option value="DE"> Germany </option>
                    <option value="GR"> Greece </option>
                    <option value="HU"> Hungary </option>
                    <option value="IS"> Iceland </option>
                    <option value="IE"> Ireland </option>
                    <option value="IL"> Israel </option>
                    <option value="IT"> Italy </option>
                    <option value="JP"> Japan </option>
                    <option value="KR"> Korea </option>
                    <option value="LU"> Luxembourg </option>
                    <option value="MX"> Mexico </option>
                    <option value="NL"> Netherlands </option>
                    <option value="NZ"> New Zealand </option>
                    <option value="NO"> Norway </option>
                    <option value="PL"> Poland </option>
                    <option value="PT"> Portugal </option>
                    <option value="SK"> Slovak Republic </option>
                    <option value="SI"> Slovenia </option>
                    <option value="ES"> Spain </option>
                    <option value="SE"> Sweden </option>
                    <option value="CH"> Switzerland </option>
                    <option value="TR"> Turkey </option>
                    <option value="UK"> United Kingdom </option>
                    <option value="US" selected> United States </option>
                </select> 
        </div>
        <div class="container inline"> 
            <label for "income">Annual Income</label>
            <input  id="calc-howrich-page-incomenumber" class="long" type="text" name="annualIncome" size="6" onchange="this.value=formatNumber(this.value,0,0);" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" /> 
            <button disabled>GBP</button>
        </div> 
        <div class="container inline">
            <label for"household_size">People in your household</label>
            Adults 
            <input disabled id="calc-howrich-page-householdsize-adult" class="short" name="householdSizeAdult" value="1" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" /> 
            Children
            <input disabled id="calc-howrich-page-householdsize-child" class="short" type="text" name="householdSizeChild" value="0" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" />
        </div>
        <div class="stretch"></div>
    </div>
    <div class="container justify grey">
      <div class="container inline">
        <input type="submit" onclick="calculateResults()">
      </div>
    </div>
  <div id="results">
       <div class="results center tcenter">
          <p> You are in the richest <span id="richpercent" class="red bold"><?php echo $results['richpercent']; ?>%</span> of the world's population. <br>
              Your income is <?php echo ($results['richtimes'] > 1)? 'more':'less' ?> than <span class="redbold"><?php echo $results['richtimes']; ?>%</span> of the global average. </p>
      </div>
      <div class="container center tcenter">
          <div class="container inline middle">
              <div class="round-box red">
                  <p> If you were to donate <span id="percentage">10</span>% of your income: </p>  
                  <div id="slider"></div>
                  <p> You would still be in the richest <?php echo $results['richpercent']; ?>%  of the world's population. Your income would still be more than <?php echo $results['richtimes']; ?> times the global average. </p>
                  <p class="bold" > And with your donation, every year... </p> 
              </div>
                  <b class="notch"></b> 
              </div>
          <div class="container inline middle">
              <input data-readonly="true" type="text" value="90" class="knob" data-width="300" data-height="300" data-max="100" data-min="0" data-fgcolor="#ffa800">
          </div>
      </div>
      <div class="container center tcenter">
          <div class="container inline">
              <?php include path_to_theme()."/templates/sharing/socialshare.php" ?>
          </div>
      </div>
  
      <div class="container" id="AMF">
      </div>
      <div class="container" id="SCI">
      </div>   
  </div>
</div>

<script>
    jQuery(function() {
        jQuery('#slider').slider({
            value: 10,
            min: 0,
            max: 100,
            slide: function(event, ui) {
                jQuery('#percentage').text(ui.value);
                jQuery('.knob').val(100-ui.value);
                jQuery('.knob').trigger('change');
            }
        });
    });

    jQuery(function() {
        jQuery(".knob").knob({
                displayInput: false,
                angleArc: 334,
                thickness: ".15"
            });
    });

    jQuery(function() {
      jQuery("#results").hide();
    });

    jQuery(function(){
       jQuery.getScript("<?php global $base_url; echo ($base_url."/sites/all/themes/summerton/templates/calculator/calculator.js") ?>", function(){
       calculateWealth();
      });
    });
    function calculateWealth(){
      var country = '<?php echo $country ?>';
      var income = <?php echo $income ?>;
      var adult = <?php echo $adult?>;
      var child = <?php echo $child?>;
      var richFactor = 0;
      income = equivaliseIncome(income, adult, child); 
      income = convertCurrency(income, country);
      income = convertIntoPpp(income, country);
      income = convertTo2008(income);
      richFactor = richFactor(income);
      jQuery('#richpercent').text("0");
   };

  function showResults(){
    jQuery("#results").show();
   } 
  function calculateResults(){
    calculateWealth();
    showResults();
}
</script>
