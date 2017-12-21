package com.example.sofyan.tempepetis;

import android.os.Bundle;
import android.view.View;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;


/**
 * Created by Sofyan on 27/11/2017.
 */

public class OneFragment extends android.support.v4.app.Fragment {
    OneFragment OneFragment(){
        return this;
    }

    private AutoCompleteTextView mInputTokenView;
    private Button btnTopUp;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup content, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragment_one, content, false);

        //btnTopUp = (Button) findViewById(R.id.btn_topup);
        //mInputTokenView = (AutoCompleteTextView) findViewById(R.id.input_token);
    }



}


