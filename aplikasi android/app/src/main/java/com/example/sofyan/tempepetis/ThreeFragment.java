package com.example.sofyan.tempepetis;

import android.media.Image;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.DividerItemDecoration;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by Sofyan on 27/11/2017.
 */

public class ThreeFragment extends android.support.v4.app.Fragment {
    UserPref up   = new UserPref();
    Pelanggan pel = new Pelanggan();

    private RecyclerView daftar;
    private View v;
    private List<Aduan> aduan = new ArrayList<>();
    private AduanAdapter mAdapter;
    private int counter;

    private EditText inputText;
    private ImageButton btnSend;

    private Handler handler = new Handler();
    private Runnable runnable;


    public ThreeFragment(){}
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        v = inflater.inflate(R.layout.fragment_three, content,false);
        daftar = (RecyclerView) v.findViewById(R.id.listAduan);
        mAdapter = new AduanAdapter(aduan);

        inputText = (EditText) v.findViewById(R.id.editText);
        btnSend = (ImageButton) v.findViewById(R.id.btn_send);

        daftar.setHasFixedSize(true);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getActivity());

        daftar.setLayoutManager(mLayoutManager);
        daftar.addItemDecoration(new DividerItemDecoration(getActivity(),LinearLayoutManager.VERTICAL));
        daftar.setItemAnimator(new DefaultItemAnimator());

        daftar.setAdapter(mAdapter);
        counter = aduan.size();

        runnable = new Runnable() {
            @Override
            public void run() {
                try {
                    if(isAdded()) {
                        aduan.clear();
                        JSONArray arrayAduan = new JSONArray(up.getstring(getActivity(), "aduan")); //ini ambil data meteran, adanya "meteran" "userdata" "history" sama "aduan"

                        for(int i=0;i<arrayAduan.length();i++){
                            JSONObject objAdu = arrayAduan.getJSONObject(i);
                            Aduan adu = new Aduan(objAdu.getString("teks_aduan"),objAdu.getString("status"));

                            aduan.add(adu);
                        }

                        if(counter!=aduan.size()) {
                            counter = aduan.size();
                            mAdapter.notifyDataSetChanged();
                        }
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                handler.postDelayed(runnable,4000); //tiap 4 sekali liat data yang masuk
            }
        };

        btnSend.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View view) {
               final String input = inputText.getText().toString();
               String addr = up.getstring(getActivity(), "address") + "/post/aduan/";
               inputText.clearFocus();
               inputText.setText("");

               if (input.length() > 20)
               {   RequestQueue queue = Volley.newRequestQueue(getActivity());
                   StringRequest postRequest = new StringRequest(Request.Method.POST, addr,
                           new Response.Listener<String>() {
                               @Override
                               public void onResponse(String response) {
                                   try {
                                       JSONObject jobj = new JSONObject(response);
                                       Toast.makeText(getActivity(), jobj.getString("response").toString(), Toast.LENGTH_LONG).show();
                                   } catch (JSONException e) {
                                       Toast.makeText(getActivity(), "Request Error", Toast.LENGTH_LONG).show();
                                   }
                               }
                           },
                           new Response.ErrorListener() {
                               @Override
                               public void onErrorResponse(VolleyError error) {
                               }
                           }
                   ) {
                       @Override
                       protected Map<String, String> getParams() {
                           Map<String, String> params = new HashMap<String, String>();
                           params.put("teks", input);
                           return params;
                       }
                   };
                   queue.add(postRequest);
               }
               else Toast.makeText(getActivity(), "Teks Aduan Terlalu Singkat", Toast.LENGTH_LONG).show();

           }
       });

                handler.post(runnable);

        return v;
    }
}
