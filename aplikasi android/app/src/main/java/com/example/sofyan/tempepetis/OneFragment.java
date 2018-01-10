package com.example.sofyan.tempepetis;

import android.icu.text.UnicodeSetSpanner;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.DividerItemDecoration;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

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
import java.util.List;


/**
 * Created by Sofyan on 27/11/2017.
 */

public class OneFragment extends android.support.v4.app.Fragment {

    UserPref up   = new UserPref();
    Pelanggan pel = new Pelanggan();

    private RecyclerView daftar;
    private View v;
    private List<History> hist = new ArrayList<>();
    private HistoryAdapter mAdapter;
    private int counter;

    private Handler handler = new Handler();
    private Runnable runnable;

    OneFragment OneFragment(){
        return this;
    }

    private AutoCompleteTextView mInputTokenView;
    private Button btnTopUp;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        v = inflater.inflate(R.layout.fragment_one, content,false);
        daftar = (RecyclerView) v.findViewById(R.id.listBayar);
        btnTopUp = (Button) v.findViewById(R.id.btn_topup);
        mInputTokenView = (AutoCompleteTextView) v.findViewById(R.id.input_token);

        mAdapter = new HistoryAdapter(hist);

        daftar.setHasFixedSize(true);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getActivity());

        daftar.setLayoutManager(mLayoutManager);
        daftar.addItemDecoration(new DividerItemDecoration(getActivity(),LinearLayoutManager.VERTICAL));
        daftar.setItemAnimator(new DefaultItemAnimator());

        daftar.setAdapter(mAdapter);
        counter = hist.size();

        runnable = new Runnable() {
            @Override
            public void run() {
                try {
                    if(isAdded()) {
                        hist.clear();
                        JSONArray arrayHistory = new JSONArray(up.getstring(getActivity(), "history")); //ini ambil data meteran, adanya "meteran" "userdata" "history" sama "aduan"

                        for(int i=0;i<arrayHistory.length();i++){
                            JSONObject objHist = arrayHistory.getJSONObject(i);
                            History h = new History(objHist.getString("no_token"),objHist.getString("tgl_beli"),objHist.getString("nominal"),objHist.getString("status"));
                            hist.add(h);
                        }

                        if(counter<hist.size()) {
                            counter = hist.size();
                            mAdapter.notifyDataSetChanged();
                        }
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                handler.postDelayed(runnable,4000); //tiap 4 sekali liat data yang masuk
            }
        };

        btnTopUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String input = mInputTokenView.getText().toString();
                String addr  = up.getstring(getActivity(),"address")+"/post/token/"+input;
                mInputTokenView.setText("");
                mInputTokenView.clearFocus();

                RequestQueue queue = Volley.newRequestQueue(getActivity());
                StringRequest stringRequest = new StringRequest(Request.Method.GET, addr,
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
                        }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getActivity(), "Network Request Error", Toast.LENGTH_LONG).show();
                    }
                });
                queue.add(stringRequest);
            }
        });

        handler.post(runnable);

        return v;
    }



}


