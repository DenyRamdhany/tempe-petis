package com.example.sofyan.tempepetis;

import android.os.Bundle;
import android.os.Handler;
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
import java.util.Map;

/**
 * Created by Sofyan on 27/11/2017.
 */

public class ThreeFragment extends android.support.v4.app.Fragment {
    UserPref up   = new UserPref();
    Pelanggan pel = new Pelanggan();
    final Map<String, String> listItemMap = new HashMap<String, String>();

    private ListView listv;
    private View v;
    ArrayList<HashMap<String,String>> list = new ArrayList<HashMap<String,String>>();
    private SimpleAdapter sa;
    private HashMap<String,String> item;

    private Handler handler = new Handler();
    private Runnable runnable;


    public ThreeFragment(){}
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        v = inflater.inflate(R.layout.fragment_three, content,false);

        runnable = new Runnable() {
            @Override
            public void run() {
                try {
                    if(isAdded()) {
                        list.clear();
                        JSONArray adu = new JSONArray(up.getstring(getActivity(), "aduan")); //ini ambil data meteran, adanya "meteran" "userdata" "history" sama "aduan"

                        for(int i=0;i<adu.length();i++){
                            JSONObject aduan = adu.getJSONObject(i);

                            item = new HashMap<String,String>();
                            item.put( "line1", aduan.getString("teks_aduan"));
                            item.put( "line2", aduan.getString("status_aduan"));
                            list.add( item );
                        }
                        sa = new SimpleAdapter(getActivity(), list,
                                android.R.layout.simple_list_item_2,
                                new String[] { "line1","line2" },
                                new int[] {R.id.textView,R.id.textView});

                        if(!list.isEmpty()) {
                            listv = (ListView) v.findViewById(R.id.listdata);
                            listv.setAdapter(sa);
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
