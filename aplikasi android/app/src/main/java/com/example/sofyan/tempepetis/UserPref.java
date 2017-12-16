package com.example.sofyan.tempepetis;

import android.content.Context;
import android.content.SharedPreferences;
import android.support.v4.content.ContextCompat;

import org.json.JSONObject;

public class UserPref {

    public void saveData(Context context, String key, String value) {
        SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putString(key,value);
        editor.commit();
    }

    public void saveInt(Context context, String key, int value) {
        SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putInt(key,value);
        editor.commit();
    }

    public void login(Context context, String key)
    {   SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putInt(key,1);
        editor.commit();
    }

    public void clearData(Context context)
    {   SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.clear();
        editor.commit();
    }

    public String getstring(Context context, String key)
    {   SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        return sharedPref.getString(key,"null");
    }

    public int getInt(Context context, String key)
    {   SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        return sharedPref.getInt(key,-1);
    }

    public boolean isexist(Context context, String key)
    {   SharedPreferences sharedPref = context.getSharedPreferences("UserPref",Context.MODE_PRIVATE);
        return sharedPref.contains(key);
    }

}