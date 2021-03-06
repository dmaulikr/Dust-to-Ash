package alixia.ash;

import java.awt.Graphics;

import javax.swing.JFrame;

public class World {

	private final Map overworld, underworld, hell, moon, ocean;
	private Map currentMap;
	private final Ash instance;

	public World(Ash instance) {
		overworld = new Map(instance, Map.Type.OVERWORLD);
		underworld = new Map(instance, Map.Type.UNDERWORLD);
		hell = new Map(instance, Map.Type.HELL);
		moon = new Map(instance, Map.Type.MOON);
		ocean = new Map(instance, Map.Type.OCEAN);

		currentMap = overworld;

		this.instance = instance;
	}

	public void dispose() {
		overworld.dispose();
		underworld.dispose();
		hell.dispose();
		moon.dispose();
		ocean.dispose();
	}

	public Map getHellMap() {
		return hell;
	}

	public Ash getInstance() {
		return instance;
	}

	public Map getMoonMap() {
		return moon;
	}

	public Map getOceanMap() {
		return ocean;
	}

	public Map getOverworldMap() {
		return overworld;
	}

	public Map getUnderworldMap() {
		return underworld;
	}

	public void initialize() {
		overworld.initialize();
		underworld.initialize();
		hell.initialize();
		moon.initialize();
		ocean.initialize();
	}

	public void onRender(Graphics graphics, JFrame observer) {
		//The map is responsible for the background and the Tiles (the ground).
		currentMap.onRender(graphics, observer);
	}

	public void onTick() {
		overworld.onTick();
		underworld.onTick();
		hell.onTick();
		moon.onTick();
		ocean.onTick();
	}

}
