import java.util.ArrayList;
import java.util.Collections;
import java.util.LinkedList;
import java.util.Queue;

public class KruskalMST {
    
    private double weight;                        // weight of MST
    private ArrayList<Edge> mst = new ArrayList<Edge>();  // edges in MST

    public KruskalMST(EdgeWeightedGraph G) {
        // more efficient to build heap by passing array of edges
    	LinkedList<Edge> pq = new LinkedList<Edge>();
        for (Edge e : G.edges()) {
            pq.add(e);
        }
        Collections.sort(pq);
        
        // run greedy algorithm
        UF uf = new UF(G.V());
        while (!pq.isEmpty() && mst.size() < G.V() - 1) {
            Edge e = pq.remove(0);
            int v = e.from();
            int w = e.other(v);
            if (!uf.connected(v, w)) { // v-w does not create a cycle
                uf.union(v, w);  // merge v and w components
                mst.add(e);  // add edge e to mst
                weight += e.weight();
            }
        }
    }

    public ArrayList<Edge> edges() { return mst; }

    public double weight() { return weight; }
}


/******************************************************************************
 *  Copyright 2002-2015, Robert Sedgewick and Kevin Wayne.
 *
 *  This file is part of algs4.jar, which accompanies the textbook
 *
 *      Algorithms, 4th edition by Robert Sedgewick and Kevin Wayne,
 *      Addison-Wesley Professional, 2011, ISBN 0-321-57351-X.
 *      http://algs4.cs.princeton.edu
 *
 *
 *  algs4.jar is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  algs4.jar is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with algs4.jar.  If not, see http://www.gnu.org/licenses.
 ******************************************************************************/
