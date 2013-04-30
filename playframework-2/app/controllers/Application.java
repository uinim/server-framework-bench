package controllers;

import play.mvc.*;

import views.html.*;

import java.util.Calendar;
import java.util.TimeZone;

import org.codehaus.jackson.node.ObjectNode;
import play.libs.Json;
import com.avaje.ebean.*;

import java.util.*;
 
public class Application extends Controller {
  
    public static Result index() {
        return ok(index.render("Your new application is ready."));
    }
    
    public static Result api() {
    	
    	StringBuilder sb = new StringBuilder("");
    	sb.append("SELECT ");
    	sb.append("spot.*, prefecture.name AS prefecture_name ");
    	sb.append("FROM spot ");
    	sb.append("LEFT JOIN prefecture ON spot.prefecture_id = prefecture.id ");
    	sb.append("ORDER BY id DESC ");
    	sb.append("LIMIT 10");
    	
    	String sql = sb.toString();
    	List<SqlRow> sqlRows = Ebean.createSqlQuery(sql).findList();
    	
    	return ok(Json.toJson(sqlRows));
    }
    
    // JSONデータの返却
    public static Result testJson() {
		ObjectNode rootJson = Json.newObject();
		rootJson.put("localDate", Calendar.getInstance(TimeZone.getDefault())
				.getTime().toString());
		rootJson.put("utcDate",
				Calendar.getInstance(TimeZone.getTimeZone("UTC")).getTime()
						.toString());
 
		ObjectNode timeZonesJson = Json.newObject();
		for (String timeZoneId : TimeZone.getAvailableIDs()) {
			TimeZone tz = TimeZone.getTimeZone(timeZoneId);
			timeZonesJson.put(tz.getDisplayName(), tz.getID());
		}
 
		rootJson.put("timeZones", timeZonesJson);
 
		return ok(rootJson);
	}
    
    // mysqlからデータ取得
    public static Result testMysql() {
    	
    	String sql = "SELECT * FROM spot LIMIT 10"; 
    	
    	List<SqlRow> sqlRows = Ebean.createSqlQuery(sql).findList();
    	
    	return ok(Json.toJson(sqlRows));
    }
  
}
