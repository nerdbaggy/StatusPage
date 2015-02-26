this["StatusPage"] = this["StatusPage"] || {};
this["StatusPage"]["templates"] = this["StatusPage"]["templates"] || {};
this["StatusPage"]["templates"]["table"] = Handlebars.template({"1":function(depth0,helpers,partials,data) {
  var lambda=this.lambda, escapeExpression=this.escapeExpression;
  return "							<th class=\"text-center hidden-xs\">"
    + escapeExpression(lambda(depth0, depth0))
    + "</th>\n";
},"3":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, lambda=this.lambda, buffer = "                <tr>\n                    <td class=\"text-left\" >"
    + escapeExpression(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"name","hash":{},"data":data}) : helper)))
    + " <i class=\"fa fa-bars hidden-xs\" data-cid=\""
    + escapeExpression(lambda((data && data.index), depth0))
    + "\"></i> <i class=\"fa fa-line-chart hidden-xs\" data-cid=\""
    + escapeExpression(lambda((data && data.index), depth0))
    + "\" data-toggle=\"modal\" data-target=\"#latencyModal\"></i></td>\n                    <td class=\"text-center\"><div class=\"text-"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.status : depth0)) != null ? stack1.color : stack1), depth0))
    + "\">"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.status : depth0)) != null ? stack1.status : stack1), depth0))
    + "</div></td>\n";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.customuptime : depth0), {"name":"each","hash":{},"fn":this.program(4, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "                    <td class=\"text-center hidden-xs\"><div class=\"text-"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.allUpTime : depth0)) != null ? stack1.color : stack1), depth0))
    + "\">"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.allUpTime : depth0)) != null ? stack1.percent : stack1), depth0))
    + "%</div></td>\n                </tr>\n";
},"4":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "                        <td class=\"text-center hidden-xs\"><div class=\"text-"
    + escapeExpression(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"color","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helper = (helper = helpers.percent || (depth0 != null ? depth0.percent : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"percent","hash":{},"data":data}) : helper)))
    + "%</div></td>\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, buffer = "          <table class=\"table table-striped table-hover\">\n\n<thead>\n                <tr>\n                    <th>Name</th>\n		<th class=\"text-center\">Status</th>\n";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.headers : depth0), {"name":"each","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  buffer += "                </tr>\n            </thead>\n            <tbody>\n";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.checks : depth0), {"name":"each","hash":{},"fn":this.program(3, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "            </tbody>\n\n";
},"useData":true});
this["StatusPage"]["templates"]["logs"] = Handlebars.template({"1":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "                    	<tr>\n                        <td><span class=\"label label-"
    + escapeExpression(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"color","hash":{},"data":data}) : helper)))
    + "\"><i class=\"fa fa-"
    + escapeExpression(((helper = (helper = helpers.icon || (depth0 != null ? depth0.icon : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"icon","hash":{},"data":data}) : helper)))
    + "\"></i> "
    + escapeExpression(((helper = (helper = helpers.status || (depth0 != null ? depth0.status : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"status","hash":{},"data":data}) : helper)))
    + "</span></td>\n                        <td>"
    + escapeExpression(((helper = (helper = helpers.date || (depth0 != null ? depth0.date : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"date","hash":{},"data":data}) : helper)))
    + "</td>\n                        <td>"
    + escapeExpression(((helper = (helper = helpers.duration || (depth0 != null ? depth0.duration : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"duration","hash":{},"data":data}) : helper)))
    + "</td>\n                        </tr>\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, buffer = "<table class=\"table table-striped table-hover\">\n        	<thead>\n            	<tr>\n                	<th>Event</th>\n                    <th>Date-Time</th>\n                    <th>Duration</th>\n                </tr>\n                \n                <tbody>\n";
  stack1 = helpers.each.call(depth0, depth0, {"name":"each","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "                </tbody>\n            </thead>\n        </table>\n\n";
},"useData":true});