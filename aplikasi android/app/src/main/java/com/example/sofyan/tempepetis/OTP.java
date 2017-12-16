package com.example.sofyan.tempepetis;

import android.app.Application;
import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.RequestFuture;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.concurrent.ExecutionException;
import java.util.concurrent.TimeUnit;
import java.util.concurrent.TimeoutException;

/**
 * Created by SamPuc on 12/14/2017.
 */

public class OTP{
    UserPref up = new UserPref();

    public void reqOtp(final Context c, String rekening, String url){
        RequestQueue queue = Volley.newRequestQueue(c);
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url+"/reqotp/"+rekening,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jobj = new JSONObject(response);
                            Toast.makeText(c, jobj.getString("response").toString(), Toast.LENGTH_LONG).show();
                            up.saveInt(c,"OTP",jobj.getInt("status"));
                        } catch (JSONException e) {
                            Toast.makeText(c, "Request Error", Toast.LENGTH_LONG).show();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(c, "Network Request Error", Toast.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }

    public void loginOtp(final Context c, String passwd, final String url){
        final RequestQueue queue = Volley.newRequestQueue(c);
        final StringRequest stringRequest = new StringRequest(Request.Method.GET, url+"/loginotp/"+passwd,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jobj = new JSONObject(response);
                            Toast.makeText(c, jobj.getString("response").toString(), Toast.LENGTH_LONG).show();
                            if(jobj.has("address")) {
                                up.saveData(c, "address", jobj.getString("address"));
                                // REQUEST DATA START
                                StringRequest stringRequest = new StringRequest(Request.Method.GET, jobj.getString("address"),
                                        new Response.Listener<String>() {
                                            @Override
                                            public void onResponse(String responses) {
                                                try {
                                                    JSONObject jobj = new JSONObject(responses);
                                                    jobj = new JSONObject(responses);
                                                    up.saveData(c,"userdata",jobj.getString("userdata"));
                                                    up.saveData(c,"meteran",jobj.getString("meteran"));
                                                    up.saveData(c,"history",jobj.getString("history"));
                                                    up.saveData(c,"aduan",jobj.getString("aduan"));
                                                } catch (JSONException e) {
                                                }
                                            }
                                        }, new Response.ErrorListener() {
                                    @Override
                                    public void onErrorResponse(VolleyError error) {
                                    }
                                });
                                queue.add(stringRequest);
                                //REQUEST DATA END
                            }
                        } catch (JSONException e) {
                            Toast.makeText(c, "Request Error", Toast.LENGTH_LONG).show();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(c, "Network Request Error", Toast.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }
}
