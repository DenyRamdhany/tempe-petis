package com.example.sofyan.tempepetis;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    private static final String TAG = MainActivity.class.getSimpleName();
    private BottomNavigationView bottomNavigation;
    private Fragment fragment;
    private FragmentManager fragmentManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        bottomNavigation = (BottomNavigationView)findViewById(R.id.navigation);
        bottomNavigation.inflateMenu(R.menu.navigation);
        bottomNavigation.getMenu().getItem(1).setChecked(true);
        //fragmentManager = getSupportFragmentManager();
        //fragment = new TwoFragment();
        //final FragmentTransaction transaction = fragmentManager.beginTransaction();
        //transaction.replace(R.id.content, fragment).commit();

        FragmentTransaction transaction = getSupportFragmentManager().beginTransaction();
        TwoFragment twoFragment = new TwoFragment();
        transaction.replace(R.id.content, twoFragment);
        transaction.commit();



        bottomNavigation.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                int id = item.getItemId();
                switch (id){
                    case R.id.navigation_one:
                        fragment = new OneFragment();
                        break;
                    case R.id.navigation_two:
                        fragment = new TwoFragment();
                        break;
                    case R.id.navigation_three:
                        fragment = new ThreeFragment();
                        break;
                    default:
                        fragment = new TwoFragment();
                        break;
                }
                //final FragmentTransaction transaction = fragmentManager.beginTransaction();
                //transaction.replace(R.id.content, fragment).commit();
                FragmentTransaction transaction = getSupportFragmentManager().beginTransaction();
                transaction.replace(R.id.content, fragment);
                transaction.commit();
                return true;
            }
        });
    }
}
