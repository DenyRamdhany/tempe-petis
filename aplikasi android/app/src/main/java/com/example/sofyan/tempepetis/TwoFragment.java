package com.example.sofyan.tempepetis;

import android.app.Activity;
import android.app.Fragment;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

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
    private ToggleButton btnMain;

    private Handler handler = new Handler();
    private Runnable runnable = new Runnable() {
        @Override
        public void run() {
            try {
                if(isAdded()) {
                    JSONObject met = new JSONObject(up.getstring(getActivity(), "meteran")); //ini ambil data meteran, adanya "meteran" "userdata" "history" sama "aduan"

                    txtDaya.setText(met.getString("sisa_kwh").toString());  // ini ambil data "sisa_kwh" dari "meteran"
                    if (met.getInt("status")==1) btnMain.setChecked(true);
                    else btnMain.setChecked(false);
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
            handler.postDelayed(runnable,4000); //tiap 4 sekali liat data yang masuk
        }
    };

    public TwoFragment TwoFragment(){
        return this;
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) { //sisanya ikutin aja ini
        View v = inflater.inflate(R.layout.fragment_two, content,false);
        txtDaya = (TextView) v.findViewById(R.id.daya);
        btnMain = (ToggleButton) v.findViewById(R.id.toggleButton_power);
        handler.post(runnable);

        return v;
    }
}
