<script>

function generate() 
{
  var members_now = parseInt(jQuery('#members').val());
  var attendees_now = parseInt(jQuery('#attendees').val());
  var hours_now = parseInt(jQuery('#hours').val());
  var hours_low_price = attendees_now * 0.10 * 200;
  var hours_high_price = attendees_now * 0.10 * 250;
  if (hours_now < 101) { 
  var attendee_rev = hours_low_price;
  var hourly_price = 200;
  } else {
  var attendee_rev = hours_high_price;
  var hourly_price = 250;
  }
  
  // Revenue chart values
  var on_demand_att = attendees_now * 0.10 * hourly_price;
  var cert = attendee_rev; 
  var spons = attendee_rev * 0.15;
  var on_demand_nonatt = attendee_rev * 0.25; 
  var new_mem = 0.0025 * 500 * members_now; 
  var engage = attendee_rev * 0.09;
  var badge = attendee_rev * 0.20;
  var tot_rev = badge + engage + new_mem + on_demand_nonatt + spons + cert + on_demand_att;
  
  //Knowledge chart values
  var know_demand_att = attendees_now * 0.10;
  var know_badge =  know_demand_att * 0.20;
  var know_cert = know_demand_att;
  var know_engage = know_demand_att * 0.09;
  var know_demand_nonatt = know_demand_att * 0.25;
  var free_content = members_now * 1.25;
  var live_meeting = attendees_now;
  var total_knowledge = know_demand_att + know_badge + know_cert + know_engage + know_demand_nonatt + free_content;  
  
  jQuery('#results').html(
    '<h3>Revenue Calculator</h3>'+
    '<ul>'+ 
      '<li class="one">Badging and Social Recognition:<span>$'+badge.formatMoney(0)+'</span></li>'+
      '<li class="two">Engagement Tools:<span>$'+engage.formatMoney(0)+'</span></li>'+
      '<li class="three">New Members:<span>$'+new_mem.formatMoney(0)+'</span></li>'+
      '<li class="four">On demand for non-attendees:<span>$'+on_demand_nonatt.formatMoney(0)+'</span></li>'+
      '<li class="five">Sponsorship:<span>$'+spons.formatMoney(0)+'</span></li>'+      
      '<li class="six">Certification:<span>$'+cert.formatMoney(0)+'</span></li>'+  
      '<li class="seven">On-demand for attendees:<span>$'+on_demand_att.formatMoney(0)+'</span></li>'+  
      '<p><strong>Total Revenue Opportunity:<span>$'+tot_rev.formatMoney(0)+'</span></strong></p>'+        
    '</ul>'+
    '<div id="revenue-chart"></div>'+
    '<div id="revenue-chart-vert" style="display:none;"></div>'+
    '<h3>Knowledge Distribution</h3>'+
    '<ul>'+
      '<li class="one">Badging and Social Recognition:<span>'+know_badge.formatMoney(0)+'</span></li>'+
      '<li class="two">Certification:<span>'+know_cert.formatMoney(0)+'</span></li>'+
      '<li class="three">Engaged Content:<span>'+know_engage.formatMoney(0)+'</span></li>'+
      '<li class="four">On-demand non-attendees:<span>'+know_demand_nonatt.formatMoney(0)+'</span></li>'+      
      '<li class="five">On-demand attendees:<span>'+know_demand_att.formatMoney(0)+'</span></li>'+     
      '<li class="six">Free Content:<span>'+free_content.formatMoney(0)+'</span></li>'+      
      '<li class="seven">Live Meeting:<span>'+live_meeting.formatMoney(0)+'</span></li>'+
      '<p><strong>Total Incremental Knowledge Distributed Opportunity:<span>'+total_knowledge.formatMoney(0)+'</span></strong></p>'+                  
    '</ul>'+   
    '<div id="knowledge-chart" style="display:none;"></div>'+      
    '<div id="knowledge-chart-vert"></div>'
  );
 
 zingchart.DEV.DEBOUNCESPEED = 50;
 
 // Revenue horizontal chart 
  zingchart.render({id: 'revenue-chart', width: '100%', height: '100%',  data: {
  "type": "hbar",
  "scale-x": {
    "values": ["Badging", "Engagement", "New Members", "On-demand Non", "Sponsorship", "Certification", "On-demand Att"],
    "value":{
      "mediaRules":[
        {
          "maxWidth":768,
          "fontSize":15
        },
        {
          "maxWidth":400,
          "visible":false
        },
        {
          "maxHeight":300,
          "visible":false
        }
      ]
    },
    "item":{
      "fontSize":13,
      "fontColor": 'black',
      "offsetY": 0,
      "mediaRules":[
        {
          "maxWidth":1024,
          "fontSize":10,
          "angle":45
        }
      ]
    }     
  },
  "plot": {
   "styles": [{"background-color": "#008ce3"},{"background-color": "#027fcd"}, {"background-color": "#006eb3"} , {"background-color": "#005f9b"}, {"background-color": "#004d7d"}, {"background-color": "#004068"}, {"background-color": "#003759"}],
    "animation": {
      "delay": "100",
      "effect": "4",
      "method": "5",
      "sequence": "1"
    }
  },
  "series": [
    {
      "values": [badge, engage, new_mem, on_demand_nonatt, spons, cert, on_demand_att]
    }
  ]
}});

// Revenue vertical chart
  zingchart.render({id: 'revenue-chart-vert', width: '100%', height: '100%', data: {
  "type": "bar",
  "scale-x": {
    "labels": ["Badging", "Engagement", "New Members", "On-demand Non", "Sponsorship", "Certification", "On-demand Att"]
  },
  "plot": {
    "styles": [{"background-color": "#008ce3"},{"background-color": "#027fcd"}, {"background-color": "#006eb3"} , {"background-color": "#005f9b"}, {"background-color": "#004d7d"}, {"background-color": "#004068"}, {"background-color": "#003759"}],    
    "animation": {
      "delay": "100",
      "effect": "4",
      "method": "5",
      "sequence": "1"
    }
  },
  "series": [
    {
      "values": [badge, engage, new_mem, on_demand_nonatt, spons, cert, on_demand_att]
    }
  ]
}});

// Knowledge horizontal chart
  zingchart.render({id: 'knowledge-chart', width: '100%', height: '100%', data: {
  "type": "hbar",
  "scale-x": {
    "labels": ["Badging", "Cert", "Engaged Content", "On-demand Non-Att", "On-demand Att", "Free Content", "Live Meeting"]      
  },
  "plot": {
    "styles": [{"background-color": "#008ce3"},{"background-color": "#027fcd"}, {"background-color": "#006eb3"} , {"background-color": "#005f9b"}, {"background-color": "#004d7d"}, {"background-color": "#004068"}, {"background-color": "#003759"}],
    "animation": {
      "delay": "100",
      "effect": "4",
      "method": "5",
      "sequence": "1"
    }
  },
  "series": [
    {
      "values": [know_badge, know_cert, know_engage, know_demand_nonatt, know_demand_att, free_content, live_meeting ]
    }
  ]
}});  

// Knowledge vertical chart
  zingchart.render({id: 'knowledge-chart-vert', width: '100%', height: '100%', data: {
  "type": "bar",
  "scale-x": {
    "labels": ["Badging", "Cert", "Engaged Content", "On-demand Non-Att", "On-demand Att", "Free Content", "Live Meeting"],
    "label":{
      "mediaRules":[
        {
          "maxWidth":768,
          "fontSize":15
        },
        {
          "maxWidth":400,
          "visible":false
        },
        {
          "maxHeight":300,
          "visible":false
        }
      ]
    },
    "item":{
      "fontSize":13,
      "fontColor": 'black',
      "offsetY": 0,
      "mediaRules":[
        {
          "maxWidth":768,
          "fontSize":10,
          "angle":45
        }
      ]
    }      
    
    
  },
  "plot": {
    "styles": [{"background-color": "#008ce3"},{"background-color": "#027fcd"}, {"background-color": "#006eb3"} , {"background-color": "#005f9b"}, {"background-color": "#004d7d"}, {"background-color": "#004068"}, {"background-color": "#003759"}],    
      "animation": {
      "delay": "100",
      "effect": "4",
      "method": "5",
      "sequence": "1"
    }
  },
  "series": [
    {
      "values": [know_badge, know_cert, know_engage, know_demand_nonatt, know_demand_att, free_content, live_meeting ]
    }
  ]
}}); 

  
  jQuery('#results').show();
}

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };
 
</script>  


<form>
  <div class="form-row"><label for="Capture">Do you Capture Meetings?</label>
    <select name="meetings">
      <option value="meet-yes">Yes</option>
      <option value="meet-no">No</option>
</select></div>
  <div class="form-row"><label for="members">Number of Members</label><input type="number" id="members" value="35000" /></div>
  <div class="form-row"><label for="attendees">Number of Attendees</label><input type="number" id="attendees" value="880" /></div>
  <div class="form-row"><label for="hours">Number of Hours</label><input type="number" id="hours" value="100" /></div>

  <div class="form-button"><button id="calculate-button" onclick="javascript:generate(); return false;" type="button">Calculate</button></div>
</form>

<div id="results" style="display: none;"></div>
