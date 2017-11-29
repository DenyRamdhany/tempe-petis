package com.example.sofyan.tempepetis;

import android.os.Bundle;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
/**
 * Created by Sofyan on 27/11/2017.
 */

public class TwoFragment extends android.support.v4.app.Fragment {
    public TwoFragment(){}
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_two, content, false);
    }
}
