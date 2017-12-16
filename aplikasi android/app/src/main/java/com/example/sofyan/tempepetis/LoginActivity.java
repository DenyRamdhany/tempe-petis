package com.example.sofyan.tempepetis;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.support.annotation.NonNull;
import android.support.design.widget.Snackbar;
import android.support.design.widget.TextInputEditText;
import android.support.design.widget.TextInputLayout;
import android.support.v7.app.AppCompatActivity;
import android.app.LoaderManager.LoaderCallbacks;

import android.content.CursorLoader;
import android.content.Loader;
import android.database.Cursor;
import android.net.Uri;
import android.os.AsyncTask;

import android.os.Build;
import android.os.Bundle;
import android.provider.ContactsContract;
import android.text.TextUtils;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.inputmethod.EditorInfo;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
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

public class LoginActivity extends AppCompatActivity {
    private OTP OTPtask = new OTP();
    private UserPref up = new UserPref();

    // UI references.
    private View mProgressView;

    private TextInputEditText inputRek;
    private TextInputEditText inputPass;

    private Button btnNextOtp;
    private Button btnSignIn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        final String url =  getResources().getString(R.string.base_url);

        btnNextOtp = (Button) findViewById(R.id.btn_otp_next);
        btnSignIn  = (Button) findViewById(R.id.btn_sign_in);

        inputRek   = (TextInputEditText) findViewById(R.id.no_rek);
        inputPass  = (TextInputEditText) findViewById(R.id.passwd);

        mProgressView = (ProgressBar) findViewById(R.id.login_progress);

        if(up.isexist(getApplicationContext(),"address")){
            Intent intent = new Intent(getApplicationContext(), MainActivity.class);
            startActivity(intent);
            finish();
        } else up.clearData(getApplicationContext());

        btnNextOtp.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                if(TextUtils.isEmpty(inputRek.getText().toString())) inputRek.setError("Masukan Nomor Rekening Anda");
                else {
                    OTPtask.reqOtp(getApplicationContext(), inputRek.getText().toString(), url);
                    OTPTaskCheck check = new OTPTaskCheck();
                    check.execute();
                }
            }
        });

        btnSignIn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                if(TextUtils.isEmpty(inputPass.getText().toString())) inputPass.setError("Masukan OTP Anda");
                else{
                    OTPtask.loginOtp(getApplicationContext(),inputPass.getText().toString(),url);
                    LoginTaskCheck check = new LoginTaskCheck();
                    check.execute();

                }
            }
        });
    }

    private class OTPTaskCheck extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(final String... data) {
            long startTime = System.currentTimeMillis(); //fetch starting time
            runOnUiThread(new Runnable() {
                @Override
                public void run() {
                    mProgressView.setVisibility(View.VISIBLE);
                }
            });
            while((System.currentTimeMillis()-startTime)<4000 && up.getInt(getApplicationContext(),"OTP")<=0);
            if(up.getInt(getApplicationContext(),"OTP")==1) {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        btnNextOtp.setVisibility(View.GONE);
                        inputRek.setEnabled(false);
                        btnSignIn.setVisibility(View.VISIBLE);
                        inputPass.setVisibility(View.VISIBLE);
                        mProgressView.setVisibility(View.GONE);
                    }
                });
            }
            return null;
        }
    }

    private class LoginTaskCheck extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(final String... data) {
            runOnUiThread(new Runnable() {
                @Override
                public void run() {
                    mProgressView.setVisibility(View.VISIBLE);
                }
            });
            long startTime = System.currentTimeMillis(); //fetch starting time
            while((System.currentTimeMillis()-startTime)<4000 && !up.isexist(getApplicationContext(),"address"));
            if(up.isexist(getApplicationContext(),"address")) {
                Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(intent);
                finish();
            }
            return null;
        }
    }
}

