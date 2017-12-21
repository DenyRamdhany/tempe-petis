package com.example.sofyan.tempepetis;

import android.os.Bundle;
import android.os.Handler;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.DividerItemDecoration;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

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

    private Handler handler = new Handler();
    private Runnable runnable;


    public ThreeFragment(){}
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        v = inflater.inflate(R.layout.fragment_three, content,false);
        daftar = (RecyclerView) v.findViewById(R.id.listAduan);
        mAdapter = new AduanAdapter(aduan);

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
                            Aduan adu = new Aduan(objAdu.getString("teks_aduan"),objAdu.getString("status_aduan"));
                            aduan.add(adu);
                        }

                        if(counter<aduan.size()) {
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

        handler.post(runnable);

        return v;
    }
}
