package com.example.sofyan.tempepetis;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by SamPuc on 12/17/2017.
 */

public class Pelanggan {
    UserPref up = new UserPref();

    public void updateData(final Context c, final String url){
        final RequestQueue queue = Volley.newRequestQueue(c);
        final StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jobj = new JSONObject(response);
                            jobj = new JSONObject(response);
                            //up.saveData(c,"userdata",jobj.getString("userdata"));
                            up.saveData(c,"meteran",jobj.getString("Meteran"));
                            up.saveData(c,"history",jobj.getString("Token"));
                            up.saveData(c,"aduan",jobj.getString("Aduan"));
                            //Toast.makeText(c,jobj.getString("Aduan"),Toast.LENGTH_LONG).show();
                        } catch (JSONException e) {
                            Toast.makeText(c, "JSON Error", Toast.LENGTH_LONG).show();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(c, "Request Error", Toast.LENGTH_LONG).show();
            }
        });
        queue.add(stringRequest);
    }
}
