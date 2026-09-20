<div class="dashboard">

    <div class="voorraad">

        <table>

            <tr>
                <th>Id</th>
                <th>Naam</th>
                <th>Gewicht</th>
                <th>Kleur</th>
                <th>Dikte</th>
                <th>Soort</th>
                <th>Gelooid</th>
                <th>Prijs</th>
                <th>Voorraad</th>
                <th>Actie</th>
            </tr>

            <?php if ($result->num_rows === 0): ?>

                <tr>
                    <td colspan="10">Geen producten gevonden.</td>
                </tr>

            <?php else: ?>

                <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>

                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['naam']) ?></td>
                        <td><?= htmlspecialchars($row['gewicht']) ?></td>
                        <td><?= htmlspecialchars($row['kleur']) ?></td>
                        <td><?= htmlspecialchars($row['dikte']) ?></td>
                        <td><?= htmlspecialchars($row['soort']) ?></td>
                        <td><?= htmlspecialchars($row['gelooid']) ?></td>
                        <td>€<?= htmlspecialchars($row['prijs']) ?></td>
                        <td><?= htmlspecialchars($row['voorraad']) ?></td>
                        <td>

                            <?php if ($row['voorraad'] > 0): ?>

                                <button
                                    type="button"
                                    class="bestel-knop"
                                    data-id="<?= (int)$row['id'] ?>"
                                    data-naam="<?= htmlspecialchars($row['naam'], ENT_QUOTES) ?>"
                                    data-prijs="<?= (float)$row['prijs'] ?>"
                                    data-voorraad="<?= (int)$row['voorraad'] ?>"
                                >
                                    🛒 Bestellen
                                </button>

                            <?php else: ?>

                                <button
                                    type="button"
                                    disabled
                                >
                                    Niet op voorraad
                                </button>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endwhile; ?>

            <?php endif; ?>

        </table>

    </div>

    <div class="sidebar">

        <div class="voorraad-box">

            <h2>Voorraad</h2>

            <p>🟢 Op voorraad</p>
            <p>🔴 Niet op voorraad</p>

        </div>

        <div class="filters">

            <select name="kleur">

                <option value="">Alle kleuren</option>

                <?php while ($row = $result_kleuren->fetch_assoc()): ?>

                    <option
                        value="<?= htmlspecialchars($row['kleur']) ?>"
                        <?= $kleur === $row['kleur'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($row['kleur']) ?>
                    </option>

                <?php endwhile; ?>

            </select>


            <select name="gelooid">

                <option value="">Gelooid</option>

                <option
                    value="natuurlijk"
                    <?= $gelooid === 'natuurlijk' ? 'selected' : '' ?>
                >
                    Natuurlijk
                </option>

                <option
                    value="chemisch"
                    <?= $gelooid === 'chemisch' ? 'selected' : '' ?>
                >
                    Chemisch
                </option>

            </select>


            <select name="soort">

                <option value="">Alle soorten</option>

                <?php while ($row = $result_soorten->fetch_assoc()): ?>

                    <option
                        value="<?= htmlspecialchars($row['soort']) ?>"
                        <?= $soort === $row['soort'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($row['soort']) ?>
                    </option>

                <?php endwhile; ?>

            </select>


            <button type="submit">
                Filteren
            </button>

            <button
                type="button"
                onclick="location.href='dashboard.php'"
            >
                Reset
            </button>

        </div>

    </div>

</div>

