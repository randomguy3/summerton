<?php 

drupal_add_library('system', 'ui');
drupal_add_library('system', 'ui.widget');
drupal_add_library('system', 'ui.mouse');
drupal_add_library('system', 'ui.slider');

$results['richpercent'] = 21;
$results['richtimes'] = 24;
/* 
 * Calculator: Template theme used in summerton
 *
 *
 */
?>
<div class="container calculator how-rich">
    <div class="content-header">
        <h1> How rich am I?</h1>
    </div>
    <div class="container banner">
        <div class="container inline">
            <label for="country">Location:</label>
        </div>
        <div class="container inline">
            <select name="country" onChange="updateCurrency(); calculateResults()" id="calc-howrich-country" class="calcselect">
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
            <label for "income">Annual Income:</label>
        </div>
        <div class="container inline">
            <input  id="calc-howrich-incomenumber" class="long" type="text" value="1000" name="annualIncome" size="6" onchange="calculateResults()" /> 
            <button name="currency" disabled>USD</button>
        </div> 
        <div class="container inline">
            <label for"household_size">People in your household:</label>
        </div>
        <div class="container inline">
            Adults:  
            <input id="calc-howrich-householdsize-adult" class="short" name="householdSizeAdult" value="1" onchange="calculateResults()" /> 
            Children:  
            <input id="calc-howrich-householdsize-child" class="short" type="text" name="householdSizeChild" value="0" onchange="calculateResults()"/>
        </div>
        <div class="stretch"></div>
        <div class="container inline">
          </div>
        </div>
      </div>
    <div id="results">
      <div class="results center tcenter">
        <p class="page-leader"> You are in the richest <span class="red bold"><span id="richpercent">0</span>%</span> of the world's population. <br>
        Your income is more than <span class="red bold"> <span id="richtimes">0</span> times</span> the global average. </p>
        </div>
      <div class="donation-selector">
        <div class="donation-selector-row">
          <div class="donation-text-box">
            <p class="bold"> If you were to donate <span id="percentage">10</span>% of your income: </p>  
            <div id="slider"></div>
            <p> You would still be in the richest <span id="netRichPercent">100</span>  of the world's population. Your income would still be more than <span id="netRichTimes">0</span> times the global average. </p>
            <p class="bold" > And with your donation, every year... </p>
          </div>
          <b class="notch"></b>
          <div class="outer-dial-container">
              <div class="right-decoration"> </div>
              <div class="dial-circularmargin"> </div>
              <div class="front-dial-container">
                <input data-readonly="true" type="text" value="0" class="knob front" data-width="300" data-height="300" data-max="100" data-min="0" data-fgcolor="#ffa800" data-bgcolor="rgba(0,0,0,0)" data-linecap="round" angleArc="360">
              </div>
              <div class="back-dial-container">
                <input data-readonly="true" type="text" value="0" class="knob back" data-width="300" data-height="300" data-max="100" data-min="0" data-fgcolor="rgb(108,0,0)" data-bgcolor="rgba(0,0,0,0)" data-linecap="round" angleArc="360">  
              <b class="notch">
            </div>
          </div>
      </div>
      <div class="container center tcenter">
        <div class="container inline">
          <?php include path_to_theme()."/templates/sharing/socialshare.php" ?>
        </div>
      </div>
      <div class="container" id="AMF"> </div>
      <div class="container" id="SCI"> </div>   
    </div>
  </div>
</div>
<script src="/sites/all/themes/summerton/templates/calculator/howrichmaths.js"></script>
<script>
    jQuery(function() {
        jQuery('#slider').slider({
            value: 10,
            min: 0,
            max: 100,
            slide: function(event, ui) {
                jQuery('#percentage').text(ui.value);
                window.wealthCalculator.donationAmount = ui.value; 
                window.wealthCalculator.potentialWealth();
            }
        });
    });

    jQuery(function() {
        jQuery(".knob").knob({
                displayInput: false,
                angleArc:"360",
                thickness: ".15",
            });
    });

    jQuery(function() {
      fadeInBack();
    });

    jQuery(function(){
       jQuery.getScript("/sites/all/themes/summerton/templates/calculator/howrichmaths.js", function(){
      });
    });
    jQuery(function(){
      window.wealthCalculator = new wealthCalculator("US", 0, 1, 0);
      window.wealthCalculator.updateWealth();
      window.wealthCalculator.calculateWealth();
      window.wealthCalculator.potentialWealth();
    });
    function wealthCalculator(country, income, adult, child) {
      this.country = country;
      this.grossIncome = income;
      this.adult = adult;
      this.child = child;
      this.richFactorNum = 0;
      this.donationAmount = 10;
      this.updateWealth=updateWealth;
      this.richFactorNum = 0;
      this.income = 0;
      this.richPercentageNum = 0;
      function updateWealth(){
        this.country = jQuery("#calc-howrich-country option:selected").val();
        this.grossIncome =  jQuery("#calc-howrich-incomenumber").val();
        this.adult = jQuery("#calc-howrich-householdsize-adult").val();
        this.child = jQuery("#calc-howrich-householdsize-child").val();
      }
      this.calculateWealth=calculateWealth;
      function calculateWealth(){
        this.income = equivaliseIncome(this.grossIncome, this.adult, this.child); 
        this.income = convertCurrency(this.income, this.country);
        this.income = convertIntoPpp(this.income, this.country);
        this.income = convertTo2008(this.income);
        this.income = incomeTooHigh(this.income);
        this.income = incomeTooLow(this.income);
        this.income = this.income*((100-this.donationAmount)/100);
        this.richFactorNum = richFactor(this.income);
        this.richPercentageNum = richPercentage(this.income);
     }
     this.potentialWealth = potentialWealth;
     function potentialWealth(){
        this.potentialIncome = this.income*((100-this.donationAmount)/100);
     }
   }

  function showResults(){
    jQuery(".donation-text-box").css('visibility','visible').hide().fadeIn('slow');
    jQuery(".right-decoration").css('visibility','visible').hide().fadeIn('slow');
    var delay = setInterval(function(){clearInterval(delay);fadeInFront();},500);
   } 
  function calculateResults(){
    window.wealthCalculator.updateWealth();
    window.wealthCalculator.calculateWealth();
    window.wealthCalculator.potentialWealth();
    window.wealthCalculator.updateDisplay(window.wealthCalculator.richFactorNum, window.wealthCalculator.richPercentageNum);
    updatePotentialDisplay(richFactor(wndow.wealthCalculator.potentialIncome), richPercentage(window.wealthCalculator.potentialIncome));
  }
  function updateCurrency(){
    jQuery(":button").text(getCurrency(jQuery("#calc-howrich-country option:selected").val()));
  }
  function updateDisplay(richFactorNum, richPercentageNum){
      jQuery("#richpercent").text(richPercentageNum.toFixed(1));
      jQuery("#richtimes").text(richFactorNum.toFixed(1));
      jQuery('.knob.back').val(100-richPercentageNum);
      jQuery('.knob.back').trigger('change');
  }
  function updatePotentialDisplay(richFactor, richPercentage){
    jQuery("#netRichPercent").text(richPercentage.toFixed(1));
    jQuery("#netRichTimes").text(richFactor.toFixed(1));
    jQuery('.knob.front').val(100-richPercentage);
    jQuery('.knob.front').trigger('change');
  }
  function fadeInBack(){
      var i = 0;
      var timer = setInterval(function(){
      jQuery('.knob.back').val(i);
      jQuery('.knob.back').trigger('change');
      if (i < 100-window.wealthCalculator.richPercentageNum) { i = i+1;} else {clearInterval(timer); var delay = setInterval(function(){clearInterval(delay); showResults();},500);}
      },10 );
  }
  function fadeInFront(){
      var i = 0;
      var timer = setInterval(function(){
      jQuery('.knob.front').val(i);
      jQuery('.knob.front').trigger('change');
      if (i < 100-richPercentage(window.wealthCalculator.potentialIncome)) { i = i+1;} else {clearInterval(timer);}
      },10 );
  }
</script>
