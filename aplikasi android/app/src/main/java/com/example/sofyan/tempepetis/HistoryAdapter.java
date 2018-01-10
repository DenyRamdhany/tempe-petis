package com.example.sofyan.tempepetis;

import android.graphics.Color;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.google.common.base.Splitter;

import java.util.List;

/**
 * Created by SamPuc on 12/22/2017.
 */

public class HistoryAdapter extends RecyclerView.Adapter<HistoryAdapter.MyViewHolder> {

    private List<History> data;

    public HistoryAdapter(List<History> data){this.data=data;}

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView text, status;

        public MyViewHolder(View view) {
            super(view);
            text   = (TextView) view.findViewById(R.id.line_a);
            status = (TextView) view.findViewById(R.id.line_b);
        }
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.listdata, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(HistoryAdapter.MyViewHolder holder, int position) {
        History hist = data.get(position);
        String token = hist.getToken();
        String newToken="";
        Iterable<String> pieces = Splitter.fixedLength(4).split(token);
        for (String piece:pieces) {
            newToken += piece + "-";
        }
        holder.text.setText(newToken.substring(0,newToken.length()-1));

        if(hist.getStatus().toString().equals("1")) {
            holder.status.setText(hist.getTanggal()+" - Rp."+hist.getNominal());
            holder.status.setTextColor(Color.GREEN);
        }
        else {
            holder.status.setText(hist.getTanggal()+" - Rp."+hist.getNominal());
            holder.status.setTextColor(Color.RED);
        }
//        holder.status.setText(adu.getStatus());
    }

    @Override
    public int getItemCount() {
        return data.size();
    }


}
