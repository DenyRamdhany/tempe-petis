package com.example.sofyan.tempepetis;

import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.widget.TextView;

import java.util.Random;

public class MainActivity extends AppCompatActivity {
    private static final String TAG = MainActivity.class.getSimpleName();
    private BottomNavigationView bottomNavigation;
    private Fragment fragment;
    private FragmentManager fragmentManager;

    private Pelanggan pel = new Pelanggan();
    private UserPref up = new UserPref();
    private Handler handler = new Handler();
    private Runnable runnable = new Runnable() {
        @Override
        public void run() {
            pel.updateData(getApplicationContext(),up.getstring(getApplicationContext(),"address"));
            handler.postDelayed(runnable, 4000);
        }
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        handler.postDelayed(runnable, 4000);

        bottomNavigation = (BottomNavigationView)findViewById(R.id.navigation);
        bottomNavigation.inflateMenu(R.menu.navigation);
        bottomNavigation.getMenu().getItem(1).setChecked(true);

        FragmentTransaction transaction = getSupportFragmentManager().beginTransaction();
        final OneFragment oneFragment = new OneFragment();
        final TwoFragment twoFragment = new TwoFragment();
        final ThreeFragment threeFragment = new ThreeFragment();
        transaction.replace(R.id.content, twoFragment);
        transaction.commit();

        bottomNavigation.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                int id = item.getItemId();
                switch (id){
                    case R.id.navigation_one:
                        fragment = oneFragment;
                        break;
                    case R.id.navigation_two:
                        fragment = twoFragment;
                        break;
                    case R.id.navigation_three:
                        fragment = threeFragment;
                        break;
                    default:
                        fragment = twoFragment;
                        break;
                }

                FragmentTransaction transaction = getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.content, fragment);
                transaction.commit();
                return true;
            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        up.clearData(getApplicationContext());
        handler.removeCallbacks(runnable);
        finish();
    }
}
