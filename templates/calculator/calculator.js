/*-------------------------------------------------------
DATA
-------------------------------------------------------*/

// This is the current number of US dollars needed to save a life
// Using the mid point for the range for DOTS treatment
var pricePerLifeSaved=2500; // Edit made on 16/12/2012 reflecting Givewell update of AMF: https://app.asana.com/0/2085239967787/2768418524425 change dconfirmed by Rob in same e-mail thread (alex robson)  

// This is the current number of US dollars needed to save a DALY
var pricePerDALY=55; // was $3 in gwwc1-original scripts.  last updated by tog 2012/10/27 with nums confirmed by rob w in https://app.asana.com/0/2085239967799/2105494539993

// This is the current number of US dollars needed to gain a year of school attendance
var pricePerSchoolYear=3; //  last updated by tog 2012/10/27 with nums confirmed by rob w in https://app.asana.com/0/2085239967799/2105494539993

// Set up exchange rates (correct as of 2011-12-09)
var currencyFactor={
  "CZK":0.0521,// Czech Republic koruna
  "DKK":0.17826,// Denmark krone
  "HUF":0.0045355,// Hungary forint
  "ISK":0.007818,// Iceland kro'na
  "ILS":0.26801,// Israel new shekel
  "KRW":0.000938,// Korea won
  "MXN":0.07875,// Mexico peso
  "NZD":0.83654,// New Zealand New Zealand Dollar
  "NOK":0.18014,// Norway krone
  "PLN":0.321699,// Poland zloty
  "SEK":0.154275,// Sweden krona

  "CHF":1.08272,// Switzerlandi
  "TRY":0.56715,// Turkeyi
  "CLP":0.0021,// http://www.currency.me.uk/convert/usd/clp

  "USD":1.00, 
  "AUD":1.03,// 1.02
  "CAD":0.98,// 1.03
  "EUR":1.30,// 1.34
  "GBP":1.51,// 1.57
  "JPY":0.0107// 0.0129
};

var nationalCurrency={
  "AU":"AUD",// Austrailia
  "AT":"EUR",// Austria
  "BE":"EUR",// Belgium
  "CA":"CAD",// Canada
  "CL":"CLP",// Chile
  "CZ":"CZK",// Czech Republic
  "DK":"DKK",// Denmark
  "EE":"EUR",// Estonia
  "FI":"EUR",// Finland
  "FR":"EUR",// France
  "DE":"EUR",// Germany
  "GR":"EUR",// Greece
  "HU":"HUF",// Hungary
  "IS":"ISK",// Iceland
  "IE":"EUR",// Ireland
  "IL":"ILS",// Israel
  "IT":"EUR",// Italy
  "JP":"JPY",// Japan
  "KR":"KRW",// Korea
  "LU":"EUR",// Luxembourg
  "MX":"MXN",// Mexico
  "NL":"EUR",// Netharlands
  "NZ":"NZD",// New Zealand
  "NO":"NOK",// Norway
  "PL":"PLN",// Poland
  "PT":"EUR",// Portugal
  "SK":"EUR",// Slovak Republic
  "SI":"EUR",// Slovenia
  "ES":"EUR",// Spain
  "SE":"SEK",// Sweden
  "CH":"CHF",// Switzerland
  "TR":"TRY",// Turkey
  "UK":"GBP",// United Kingdom
  "US":"USD"// United States
};

 // Set up price indexes (correct as of 2013-03-08 Y/M/D)
 // Country codes: http://www.paladinsoftware.com/Generic/countries.htm
  var priceIndex={
    "AU":1.68,// Austrailia
    "AT":1.16,// Austria
    "BE":1.21,// Belgium
    "CA":1.29,// Canada
    "CL":0.8,// Chile
    "CZ":0.82,// Czech Republic
    "DK":1.55,// Denmark
    "EE":0.87,// Estonia
    "FI":1.36,// Finland
    "FR":1.19,// France
    "DE":1.12,// Germany
    "GR":1.02,// Greece
    "HU":0.70,// Hungary
    "IS":1.22,// Iceland
    "IE":1.25,// Ireland
    "IL":1.20,// Israel
    "IT":1.15,// Italy
    "JP":1.28,// Japan
    "KR":0.87,// Korea
    "LU":1.33,// Luxembourg
    "MX":0.74,// Mexico
    "NL":1.18,// Netherlands
    "NZ":1.34,// New Zealand
    "NO":1.76,// Norway
    "PL":0.65,// Poland
    "PT":0.94,// Portugal
    "SK":0.80,// Slovak Republic
    "SI":0.93,// slovenia
    "ES":1.06,// Spain
    "SE":1.40,// Sweden
    "CH":1.68,// Switzerland
    "TR":0.77,// Turkey
    "UK":1.17,// United Kingdom
    "US":1.00// United States
  };

var conversionTo2008 = 1.108; // i.e. 10.8 % inflation from 2008-present (http://inflationdata.com/inflation/Inflation_Rate/CurrentInflation.asp)
var medianIncome = 1480;

// Setup relationship between money and population
var centileArray = [0,0.1,0.23,0.96,2,2.89,3.26,3.67,6.48,10.38,14.72,19.08,27.05,33.72,39.24,43.72,47.42,50.53,53.21,55.56,57.57,59.39,61.02,63.88,66.25,68.27,70,71.55,73.42,74.95,76.23,77.25,78.09,78.8,79.59,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,99.9];
var incomeArray = [0,12.72,63.6,127.2,190.8,228.96,241.68,254.4,318,381.6,445.2,508.8,636,763.2,890.4,1017.6,1144.8,1272,1399.2,1526.4,1653.6,1780.8,1908,2162.4,2416.8,2671.2,2925.6,3180,3561.6,3943.2,4324.8,4706.4,5088,5469.6,5978.4,6431,6949,7549,8120,8826,9506,10402,11245,12164,13323,14447,15644,17093,18307,20383,22632,25401,29491,35472,46822,70000];
var minDollarToCalc = incomeArray[centileArray.indexOf(80)]+1;
var maxDollarToCalc = incomeArray[centileArray.indexOf(99)]-1;
var veryMaxDollarToCalc=incomeArray[incomeArray.length-1]-1;

/*-------------------------------------------------------
CALCULATING SCRIPTS
-------------------------------------------------------*/

/*
*   The data comes from an as yet unpublished survey by Branco Milanovic and expresses
*   world incomes from 2002 in '2005 international dollars'. The data-point for 99.9 centile is from his 
*   "The Haves and Have-nots". This means that if you enter a salary earned in the US
*   in 2005, it would work perfectly to tell you where you ranked then in terms of perchasing power parity (PPP).
*   I have adjusted for inflation since 2005 (10.3%) which provides a rough translation of a 2009 income.
*   It is still not quite correct as it is still using the 2002 distribution (today's is probably more skewed)
*   so richness percentages for high earners are really slightly lower than indicated and for low earners are higher
*   than indicated. Also, while the currency is converted at today's market rates to 2009 US dollars
*   (then via the 1.103 factor into 2005 US dollars), it should also factor in which country you are living in,
*   as this is needed for a true PPP calculation (dollars go further in Egypt than in the USA or UK), but it works fine
*   now for the richest countries, which are where most of the site users will come from.
*
*   UPDATE: now uses Branco Milanovic's 2008 data
*
*   Based on a script by Poke ( http://www.pokelondon.com/ ) at http://www.globalrichlist.com/
*   but improved by allowing for exchange rates, household size, inflation, an updated data-set (2002 rather than 1993),
*   and using the income at each centile rather than the income-share of the range between the listed centiles
*   (which gives the wrong answers...).
*/

// returns array with
//  [0] = SLOPE, m
//  [1] = y-int, b
//  [2] = R
function calcTrendRSquare (arrX, arrY) {
  
  var n = arrX.length;    
  var sumX = 0;
  var sumY = 0;
  var sumXY = 0;
  var sumX2 = 0;
  var sumY2 = 0;
      
  for (var i = 0; i < arrX.length; i++){
    sumX += arrX[i];
    sumY += arrY[i];
    sumXY += arrX[i] * arrY[i];
    sumX2 += Math.pow(arrX[i],2);
    sumY2 += Math.pow(arrY[i],2);
  }
  
  var sumX2_2 = Math.pow(sumX,2); 
  var sumY2_2 = Math.pow(sumY,2);
  
  var slope_m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX2_2);
  var yInt_b  = (sumY - slope_m * sumX) / n;
  var r       = (n * sumXY - sumX * sumY) / Math.sqrt((n * sumX2 - sumX2_2) * (n * sumY2 - sumY2_2));
  
  var returnArray = new Array(slope_m, yInt_b, r); 
  return returnArray;
}

function getPercentPoorer(bIndex, income) {
  // get the R-square Trend
  var people = new Array(centileArray[bIndex], centileArray[bIndex+1]);
  var money  = new Array(incomeArray[bIndex], incomeArray[bIndex+1]);
  var rSquare = calcTrendRSquare(people, money);
  var percentPoorer = ((income + (rSquare[1]*-1)) / rSquare[0]);
  return percentPoorer;
}



function calcPreTax(threshold, incomeLevels, taxPercents, maxIncomeLevel) {
    
  var incomeLevel;
  var nextIncomeLevel;
	var taxPercent;
	var preTaxSoFar = 0;
	var postTaxSoFar = 0;
  
  for (var i = 0; ; i++){
    incomeLevel = incomeLevels[i];
    nextIncomeLevel = incomeLevels[i+1];
  	taxPercent = taxPercents[i];
  	if ( (incomeLevel == maxIncomeLevel) || ((nextIncomeLevel - incomeLevel) * (100 - taxPercent) / 100 + postTaxSoFar > threshold) )
  	{
  		preTaxSoFar += (threshold - postTaxSoFar) / (100 - taxPercent) * 100;
  		break;
  	}
  	else
  	{
  		postTaxSoFar += (nextIncomeLevel - incomeLevel) * (100 - taxPercent) / 100;
  		preTaxSoFar += (nextIncomeLevel - incomeLevel);
  	}
  }
	
	return preTaxSoFar;    
}

/*-------------------------------------------------------
SCRIPT FOR HOW RICH AM I?
-------------------------------------------------------*/

function richPercentage(income){
  var blockIndex = 0;
      for (var i = 0; i < incomeArray.length; i++) {
          if(income < incomeArray[i]) {
              blockIndex = i-1;
              break;
          }
      }

  var percentPoorer = getPercentPoorer(blockIndex, income);
    
  // calculate percentage 
  var percentRicher = 100 - percentPoorer;
      
  var strOutput = percentRicher.toFixed(1);

  if (income < minDollarToCalc)
  { // no output if income too low
    jQuery("#howrich-error").show();
  } 
  else if (income > maxDollarToCalc )
  {  // roughened output if income too high
    jQuery("#howrich-error").show();
    if(income>veryMaxDollarToCalc){
      strOutput="0.1";
      percentPoorer=99.9;
    }
  }

  return [strOutput,percentPoorer];

};


function howRichAmI() {

  jQuery("#howrich-income").val(formatNumber(jQuery("#howrich-income").val(),0,0));
  jQuery("#howrich-adult").val(numval(jQuery("#howrich-adult").val(),0,1));
  jQuery("#howrich-error").hide();
  jQuery("#howrich-results").show();

  var country = jQuery("#howrich-country").val();
  var income = numval(jQuery("#howrich-income").val());
  var adult = numval(jQuery("#howrich-adult").val());
  var child = numval(jQuery("#howrich-child").val());

  // equivalise the income
  income = income / ((adult==1?1:0.3+adult*0.7)+(child/2));
  
  // convert currency so we can calculate with US dollars.
  income = income * currencyFactor[nationalCurrency[country]];
  
  // divide income by the price index (to adjust for cost of living into $PPP
  income = income / priceIndex[country];

  // convert currency from current US dollars to 2008 US dollars (US$PPP)
  income = income / conversionTo2008;

  //display percentage plus graphic
  richPercentageOutput=richPercentage(income);
  jQuery("#howrich-percentage").html(richPercentageOutput[0]);
  jQuery("#howrich-percentagebar>div").css("width",richPercentageOutput[1]+"%");

  //coins graphic
  var coin2height=86;
  var coin3height=97;
  var cointopheight=63;
  var coinmiddleheight=11;
  var coinbottomheight=46;
  var richFactor=(income / medianIncome).toFixed(0);
  if(richFactor<2||richFactor>10000){
    jQuery("#howrich-factorbartable").hide();
  }
  else{
    jQuery("#howrich-factorbartable").show();
    if(richFactor==2||richFactor==3){
      jQuery("#howrich-factorbartop").css("height","0px");
      jQuery("#howrich-factorbarmiddle").css("height","0px");
      jQuery("#howrich-factorbarbottom").css("height","0px");
      if(richFactor==2){
        jQuery("#howrich-factorbar").css("height",coin2height+"px");
        jQuery("#howrich-factorbar2").css("height",coin2height+"px");
        jQuery("#howrich-factorbar3").css("height","0px");
      }
      else{
        jQuery("#howrich-factorbar").css("height",coin3height+"px");
        jQuery("#howrich-factorbar3").css("height",coin3height+"px");
        jQuery("#howrich-factorbar2").css("height","0px");
      }
    }
    else{
      jQuery("#howrich-factorbar").css("height",cointopheight+coinmiddleheight*(richFactor-4)+coinbottomheight+"px");
      jQuery("#howrich-factorbar2").css("height","0px");
      jQuery("#howrich-factorbar3").css("height","0px");
      jQuery("#howrich-factorbartop").css("height",cointopheight+"px");
      jQuery("#howrich-factorbarmiddle").css("height",coinmiddleheight*(richFactor-4)+"px");
      jQuery("#howrich-factorbarbottom").css("height",coinbottomheight+"px");
      jQuery("#howrich-factorbarbottom").css("top",cointopheight+coinmiddleheight*(richFactor-4)+"px");
    }
  }

  jQuery("#howrich-factor").html(customRound(income / medianIncome));

  jQuery("#howrich-percentage2").html(richPercentage(income*(1-jQuery("#howrich-donationpercentage").val()/100))[0]);

  jQuery("#howrich-factor2").html(customRound(income*(1-jQuery("#howrich-donationpercentage").val()/100) / medianIncome));

  //"what if you donated..." section
  jQuery("#howrich-donationpercentagedisplay").html(jQuery("#howrich-donationpercentage").val());
  var donation=numval(jQuery("#howrich-income").val())*numval(jQuery("#howrich-donationpercentage").val())*currencyFactor[nationalCurrency[country]]/100;
  jQuery("#howrich-lives").html(customRound(donation/pricePerLifeSaved));
  jQuery("#howrich-dalys").html(customRound(donation/pricePerDALY));
  jQuery("#howrich-schoolyears").html(customRound(donation/pricePerSchoolYear));
};

function customRound(n){
  return (n<10?n.toPrecision(2):n.toFixed(0))*1;
};


/*-------------------------------------------------------
UTILITIES
-------------------------------------------------------*/

function filterChars(s, charList){
  var s1 = "" + s; // force s1 to be a string data type
  var i;
  for (i = 0; i < s1.length; )
  {
    if (charList.indexOf(s1.charAt(i)) < 0)
      s1 = s1.substring(0,i) + s1.substring(i+1, s1.length);
    else
      i++;
  }
  return s1;
};
function makeNumeric(s){
  return filterChars(s, "1234567890.-");
};
function numval(val,digits,minval,maxval){
  val = makeNumeric(val);
  if (val == "" || isNaN(val)) val = 0;
  val = parseFloat(val);
  if (digits != null)
  {
    var dec = Math.pow(10,digits);
    val = (Math.round(val * dec))/dec;
  }
  if (minval != null && val < minval) val = minval;
  if (maxval != null && val > maxval) val = maxval;
  return parseFloat(val);
};
function formatNumber(val,digits,minval,maxval){
  var sval = "" + numval(val,digits,minval,maxval);
  var i;
  var iDecpt = sval.indexOf(".");
  if (iDecpt < 0) iDecpt = sval.length;
  if (digits != null && digits > 0)
  {
    if (iDecpt == sval.length)
      sval = sval + ".";
    var places = sval.length - sval.indexOf(".") - 1;
    for (i = 0; i < digits - places; i++)
      sval = sval + "0";
  }
  var firstNumchar = 0;
  if (sval.charAt(0) == "-") firstNumchar = 1;
  for (i = iDecpt - 3; i > firstNumchar; i-= 3)
    sval = sval.substring(0, i) + "," + sval.substring(i);

  return sval;
};

/*-------------------------------------------------------
SCRIPTS FOR /why-give/what-you-can-achieve AND /getting-involved/joining-us/giving-more
-------------------------------------------------------*/

// Need to take into account the US restrictions of charitable donations
function goldPledge() {

  var currentAge = numval(document.goldCalculator.currentAge.value);
  var retirementAge = numval(document.goldCalculator.retirementAge.value);
  var currency = document.goldCalculator.currency.value;
  var averageIncome = numval(document.goldCalculator.averageIncome.value);
  var threshold = numval(document.goldCalculator.threshold.value);
  var taxCountry = document.goldCalculator.taxCountry.value;
  var annualDonation = 0;
  var totalEarnings = 0;
  var totalDonation = 0;
  var livesSaved = 0;
  var dalys = 0;
  var schoolYears = 0;


  // Set up tax brackets

  // for 2009-10 tax year
  incomeLevelsAU = new Array(0, 6000, 35000, 80000, 180000, -1, -1, -1);
  taxPercentsAU  = new Array(0,   15,    30,    38,     45, -1, -1, -1);
  maxIncomeLevelAU = 95000;

  // for 2010 tax year, using 2009 personal exemption (3650) and 2009 standard deduction (5700)
  incomeBaseUS = 3650+5700;
  incomeLevelsUS = new Array(0, incomeBaseUS+0, incomeBaseUS+8375, incomeBaseUS+34000, incomeBaseUS+82400, incomeBaseUS+171850, incomeBaseUS+373650, -1);
  taxPercentsUS  = new Array(0,             10,                15,                 25,                 28,                  33,                  35, -1);
  maxIncomeLevelUS = incomeBaseUS+373650;

  // for 2009-10 and 2010-11 tax years
  incomeBaseUK = 6475;
  incomeLevelsUK = new Array(0, incomeBaseUK,	incomeBaseUK+37400, -1, -1, -1, -1, -1);
  taxPercentsUK  = new Array(0,           20,                 40, -1, -1, -1, -1, -1);
  maxIncomeLevelUK = incomeBaseUK+37400;


  currencyFactor = currencyFactor[currency];

  if ((currentAge >= 0) && (retirementAge >= currentAge) && (threshold >= 0) && (averageIncome >= threshold))
  {
     if (taxCountry == "au")
     {
     		threshold = threshold * currencyFactor / aud; // convert to local currency
     		preTaxThreshold = calcPreTax(threshold, incomeLevelsAU, taxPercentsAU, maxIncomeLevelAU);
  		preTaxThreshold = preTaxThreshold / currencyFactor * aud; // convert to nominated currency
     }
     else if (taxCountry == "uk")
     {
      	threshold = threshold * currencyFactor / gbp; // convert to local currency
     		preTaxThreshold = calcPreTax(threshold, incomeLevelsUK, taxPercentsUK, maxIncomeLevelUK);
   		preTaxThreshold = preTaxThreshold / currencyFactor * gbp; // convert to nominated currency
     }
     else if (taxCountry == "us")
     {
      	threshold = threshold * currencyFactor / usd; // convert to local currency
     		preTaxThreshold = calcPreTax(threshold, incomeLevelsUS, taxPercentsUS, maxIncomeLevelUS);
  		preTaxThreshold = preTaxThreshold / currencyFactor * usd; // convert to nominated currency
     }

     annualDonation = averageIncome - preTaxThreshold;
     totalEarnings = averageIncome * (retirementAge - currentAge);
     totalDonation = (averageIncome - preTaxThreshold) * (retirementAge - currentAge);
     livesSaved = totalDonation * currencyFactor / pricePerLifeSaved;
     dalys = totalDonation * currencyFactor / pricePerDALY;
     schoolYears = totalDonation * currencyFactor / pricePerSchoolYear;
     document.goldCalculator.annualDonation.value = formatNumber(annualDonation,0,0);
     document.goldCalculator.totalEarnings.value = formatNumber(totalEarnings,0,0);
     document.goldCalculator.totalDonation.value = formatNumber(totalDonation,0,0);
     document.goldCalculator.livesSaved.value = formatNumber(livesSaved,0,0);
     document.goldCalculator.dalys.value = formatNumber(dalys,0,0);
     document.goldCalculator.schoolYears.value = formatNumber(schoolYears,0,0);
  }
  else
  {
        document.goldCalculator.annualDonation.value = "";
        document.goldCalculator.totalEarnings.value = "";
        document.goldCalculator.totalDonation.value = "";
        document.goldCalculator.livesSaved.value = "";
        document.goldCalculator.dalys.value = "";
        document.goldCalculator.schoolYears.value = "";
  }
}


function silverPledge() {
  var te3425r = document.silverCalculator; //test
  var currentAge = numval(document.silverCalculator.currentAge.value);
  var retirementAge = numval(document.silverCalculator.retirementAge.value);
  var currency = document.silverCalculator.currency.value;
  var averageIncome = numval(document.silverCalculator.averageIncome.value);
  var percentage = numval(document.silverCalculator.percentage.value);
  var totalEarnings;
  var totalDonation;
  var livesSaved;
  var dalys;
  var schoolYears;
  var currencyFactor = currencyFactor[currency];

  if ((currentAge >= 0) && (retirementAge >= currentAge) && (averageIncome >= 0) && (percentage >= 0) && (percentage <= 100))
  {
        totalEarnings = (retirementAge - currentAge) * averageIncome;
        totalDonation = totalEarnings * percentage / 100;
  	  
  	    livesSaved = totalDonation * currencyFactor / pricePerLifeSaved;
  	    dalys = totalDonation * currencyFactor / pricePerDALY;
  	    schoolYears = totalDonation * currencyFactor / pricePerSchoolYear;

        document.silverCalculator.totalEarnings.value = formatNumber(totalEarnings,0,0);
        document.silverCalculator.totalDonation.value = formatNumber(totalDonation,0,0);
        document.silverCalculator.livesSaved.value = formatNumber(livesSaved,0,0);
        document.silverCalculator.dalys.value = formatNumber(dalys,0,0);
        document.silverCalculator.schoolYears.value = formatNumber(schoolYears,0,0);
  }
  else
  {
        document.silverCalculator.totalEarnings.value = "";
        document.silverCalculator.totalDonation.value = "";
        document.silverCalculator.livesSaved.value = "";
        document.silverCalculator.dalys.value = "";
        document.silverCalculator.schoolYears.value = "";
  }
}