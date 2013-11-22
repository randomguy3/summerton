
<div class="calculator-out">
    <div class="calculator">
        <form onsubmit="howRichGWWC3();return false;" name="howRichCalculator" id="howRichCalculator">
            <img src="http://www.givingwhatwecan.org/sites/givingwhatwecan.org/files/attachments/gwwchowrich.jpg" height="275" class="float-right" />
            <div id="calcupper">
            <h3 class="h3calc"> Where do you live? What's your annual household income (after tax)?</h3>
            <p class="legend"> Where you're living determines your local currency and your cost of living. </p >
            <div class="calccentered">
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
                <input  id="calc-howrich-page-incomenumber" class="number" type="text" name="annualIncome" size="6" onchange="this.value=formatNumber(this.value,0,0);" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" />         
                   <b id='calc-howrich-page-currency'>USD</b>
                   <br  />
            </div>
            <br />

<h3 class="h3calc">How big is your household? </h3>
<p class="legend"> The residents in your household for over half the year:<br> 
<input  id="calc-howrich-page-householdsize-adult" class="number" type="text" name="householdSizeAdult" value="1" size="6" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" /> people over 18 and <input  id="calc-howrich-page-householdsize-child" class="number" type="text" name="householdSizeChild" value="0" size="6" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" /> people under 18<a class="reference" title="click to see reference" onclick="toggleFootnote('footnote-1');" href="javascript:void(0);">1</a>
</p>
<div id="calculatebuttondiv">
<a href="javascript:void(0);" onclick="howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);" class="medium-button">Calculate <span class="arrow">&#9658;</span></a></p>
</div>
</div>

<div id="showerror" class="calcerror" style="display: none;"> Please note that our data may be less accurate for people outside of the richest 20% of the world's population.<a class="reference" title="click to see reference" onclick="toggleFootnote('footnote-2');" href="javascript:void(0);">2</a> 

<img src="/sites/givingwhatwecan.org/themes/gwwc3/images/nodes/icons/close-button-transparent.png" alt="Close error" onclick="toggleDisplay()">


</div>
<ul>
<li> <p>You are in the richest <input class="number" type="text" name="richPercentage" id="calc-howrich-page-richPercentage"   readonly="readonly" size="5" /> % of the world's population. Your income is more than <input class="number" type="text" name="richFactor" id="calc-howrich-page-richFactor" readonly="readonly" size="5" /> times that of the typical person.<a class="reference" title="click to see reference" onclick="toggleFootnote('footnote-2');" href="javascript:void(0);">2</a></p> </li>
<h3 class="h3calc">If you donate 10% of your income…</h3>
<ul>
<li>
<p>You will still be in the richest <input class="number" type="text" name="richPercentage2" id="calc-howrich-page-richPercentage2" readonly="readonly" size="5" /> % of the world's population. Your income will be more than <input class="number" type="text" name="richFactor2" id="calc-howrich-page-richFactor2" readonly="readonly" size="5" /> times that of the typical person.</p>
</li>
</ul>
<p>Surprised? Take a look at our next calculator to see how much good you can achieve with this ten per cent:<br/>
<div id="calculatebuttondiv">
<a href="http://www.givingwhatwecan.org/why-give/what-you-can-achieve" onclick="howRichGWWC3()" class="medium-button">Calculate what you can achieve<span class="arrow">&#9658;</span></a></p>
</div>
</form>
</div>
</div>
