package com.example.sofyan.tempepetis;

import android.app.Activity;
import android.app.Fragment;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

/**
 * Created by Sofyan on 27/11/2017.
 */

public class TwoFragment extends android.support.v4.app.Fragment {
    UserPref up   = new UserPref();
    Pelanggan pel = new Pelanggan();

    private TextView txtDaya;

    public TwoFragment(){}
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_two, content,false);
        txtDaya = (TextView) v.findViewById(R.id.daya);

        pel.updateData(getContext(),up.getstring(getContext(),"address"));
        JSONObject met = null;

        try {
            met = new JSONObject(up.getstring(getContext(),"meteran"));

            txtDaya.setText(met.getString("sisa_kwh").toString());
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return v;
    }
}
