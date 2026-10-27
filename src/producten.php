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

            <!-- Controleert of er producten zijn gevonden -->
            <?php if ($result->num_rows === 0): ?>

                <tr>
                    <td colspan="10">Geen producten gevonden.</td>
                </tr>

            <?php else: ?>

                <!-- Haalt elk product afzonderlijk op en toont het in de tabel -->
                <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['naam']) ?></td>
                        <td><?= htmlspecialchars($row['gewicht']) ?>kg</td>
                        <td><?= htmlspecialchars($row['kleur']) ?></td>
                        <td><?= htmlspecialchars($row['dikte']) ?>mm</td>
                        <td><?= htmlspecialchars($row['soort']) ?></td>
                        <td><?= htmlspecialchars($row['gelooid']) ?></td>
                        <td>€<?= htmlspecialchars($row['prijs']) ?></td>
                        <td><?= htmlspecialchars($row['voorraad']) ?></td>

                        <td>

                            <!-- Bedrijven kunnen producten bestellen -->
                            <?php if ($_SESSION['rol'] === 'bedrijf'): ?>

                                <?php if ($row['voorraad'] > 0): ?>

                                    <button
                                        type="button"
                                        class="bestel-knop"
                                        data-id="<?= (int)$row['id'] ?>"
                                        data-naam="<?= htmlspecialchars($row['naam']) ?>"
                                        data-gewicht="<?= (float)$row['gewicht'] ?>"
                                        data-kleur="<?= htmlspecialchars($row['kleur']) ?>"
                                        data-dikte="<?= (float)$row['dikte'] ?>"
                                        data-soort="<?= htmlspecialchars($row['soort']) ?>"
                                        data-gelooid="<?= htmlspecialchars($row['gelooid']) ?>"
                                        data-prijs="<?= (float)$row['prijs'] ?>"
                                        data-voorraad="<?= (int)$row['voorraad'] ?>"
                                    >
                                        🛒 Bestellen
                                    </button>

                                <?php else: ?>

                                    <!-- De bestelknop is uitgeschakeld als de voorraad op is -->
                                    <button type="button" disabled>
                                        Niet op voorraad
                                    </button>

                                <?php endif; ?>

                            <?php endif; ?>

                            <!-- Alleen admins kunnen producten bewerken en verwijderen -->
                            <?php if ($_SESSION['rol'] === 'admin'): ?>

                                <button
                                    type="button"
                                    class="bewerk-knop"
                                    onclick="window.location.href='bewerken.php?id=<?= (int)$row['id'] ?>'"
                                >
                                    ✏️ Bewerken
                                </button>

                                <button
                                    type="button"
                                    class="verwijder-knop"
                                    onclick="if (confirm('Weet je zeker dat je dit product wilt verwijderen?')) { window.location.href='verwijderen.php?id=<?= (int)$row['id'] ?>'; }"
                                >
                                    🗑 Verwijderen
                                </button>

                            <?php endif; ?>

                        </td>
                    </tr>

                <?php endwhile; ?>

            <?php endif; ?>

        </table>

        <!-- Paginering onder de productentabel -->
        <?php if ($totaalPaginas > 1): ?>
            <div class="paginering">

                <!-- Gaat naar de vorige pagina en behoudt de filters -->
                <?php if ($pagina > 1): ?>
                    <a href="?<?= htmlspecialchars(http_build_query(array_merge($_GET, ['pagina' => $pagina - 1]))) ?>">
                        Vorige
                    </a>
                <?php endif; ?>

                <span>
                    Pagina <?= $pagina ?> van <?= $totaalPaginas ?>
                </span>

                <!-- Gaat naar de volgende pagina en behoudt de filters -->
                <?php if ($pagina < $totaalPaginas): ?>
                    <a href="?<?= htmlspecialchars(http_build_query(array_merge($_GET, ['pagina' => $pagina + 1]))) ?>">
                        Volgende
                    </a>
                <?php endif; ?>

            </div>
        <?php endif; ?>

    </div>

    <div class="sidebar">

        <!-- Legenda die aangeeft of een product op voorraad is -->
        <div class="voorraad-box">

            <h2>Voorraad</h2>

            <p>🟢 Op voorraad</p>
            <p>🔴 Niet op voorraad</p>

        </div>

        <!-- Filteropties om specifieke producten te vinden -->
        <div class="filters">

            <select name="kleur">
                <option value="">Alle kleuren</option>

                <!-- Haalt de beschikbare kleuren uit de database -->
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

                <!-- Haalt de beschikbare soorten uit de database -->
                <?php while ($row = $result_soorten->fetch_assoc()): ?>
                    <option
                        value="<?= htmlspecialchars($row['soort']) ?>"
                        <?= $soort === $row['soort'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($row['soort']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- Verstuurt de gekozen filters via het formulier -->
            <button type="submit">Filteren</button>

            <!-- Verwijdert alle filters door terug te gaan naar het dashboard -->
            <button
                type="button"
                onclick="location.href='dashboard.php'"
            >
                Reset
            </button>

        </div>

    </div>

</div>
