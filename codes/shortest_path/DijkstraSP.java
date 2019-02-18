import java.util.Stack;

public class DijkstraSP {
	private DirectedEdge[] edgeTo;
	private double[] distTo;
	private boolean[] foundSP;
	EdgeWeightedDigraph G;

	public DijkstraSP(EdgeWeightedDigraph G, int s) {
		this.G = G;
		edgeTo = new DirectedEdge[G.V()];
		distTo = new double[G.V()];
		foundSP = new boolean[G.V()];
		for (int v = 0; v < G.V(); v++)
			distTo[v] = Double.POSITIVE_INFINITY;
		
		distTo[s] = 0.0;
		int min = s;
		
		while (min != -1) {
			foundSP[min] = true;
			
			for (DirectedEdge e : G.adj(min))
				relax(e);

			min = findMin();
		}
	}

	private void relax(DirectedEdge e) {
		int v = e.from(), w = e.to();
		if (distTo[w] > distTo[v] + e.weight()) {
			distTo[w] = distTo[v] + e.weight();
			edgeTo[w] = e;
		}
	}

	private int findMin() {
		int min = -1;
		for (int v = 0; v < G.V(); v++) {
			if (foundSP[v] == false) {
				if (min == -1)
					min = v;
				else if (distTo[v] < distTo[min])
					min = v;
			}
		}
		return min;
	}

	public double distTo(int v) { return distTo[v];	}

	public Stack<DirectedEdge> pathTo(int v)	 {
		 Stack<DirectedEdge> path = new Stack<DirectedEdge>();
		 for (DirectedEdge e = edgeTo[v]; e != null; e = edgeTo[e.from()])
			 path.push(e);
		 return path;
	}
}