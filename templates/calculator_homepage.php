<h2> How Rich Am I? </h2>
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
                <p class="small"> This determines both your currency and your cost of living. </p>
        </div>
        <div class="container inline"> 
            <label for "income">Annual Income</label>
            <input  id="calc-howrich-page-incomenumber" class="long" type="text" name="annualIncome" size="6" onchange="this.value=formatNumber(this.value,0,0);" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" /> 
            <button disabled>GBP</button>
            <p class="small"> The total combined income for your household. </p>       
        </div> 
        <div class="container inline">
            <label for"household_size">People in your household</label>
            Adults 
            <button>-</button>
            <input disabled id="calc-howrich-page-householdsize-adult" class="short" name="householdSizeAdult" value="1" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" /> 
            <button>+</button>
            Children
            <button>-</button>
            <input disabled id="calc-howrich-page-householdsize-child" class="short" type="text" name="householdSizeChild" value="0" onkeypress="if(event.keyCode==13){howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);}" />
            <button>+</button>
            <p class="small"> We use equivalised income. Find out more about this system here. </p>
        </div>
        <div class="stretch"></div>
        <div class="tcenter" id="calculatebuttondiv">
            <button onclick="howRichGWWC3(); _gaq.push(['_trackEvent', 'Click - /node/447', ' How Rich - Calculate']);" class="red">Calculate <span class="arrow">&#9658;</span></button>
        </div>
